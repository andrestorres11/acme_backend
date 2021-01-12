<?php

namespace App\Http\Controllers;

use DB;
use App\Car;
use App\Life;
use App\User;

use Illuminate\Http\Request;
use Validator;

class LifeController extends Controller
{
    public function index()
    {
        $lifeResults = Life::Where("statu_id", 1)->get();
        $life = array();

        for( $l = 0; $l < count( $lifeResults ); $l++ ){
            
            $lifeResult = Life::Where( "life_id", $lifeResults[$l]->life_id )->first();
            $carResult = Car::Where( "car_id", $lifeResult->car_id )->first();

            $driverResult = User::Where( "user_id", $lifeResult->user_id )->first();
            $ownerResult = User::Where( "user_id", $carResult->user_id )->first();
            $life[] = array(
                "id" => $lifeResult->life_encrypted,
                "carId" => $carResult->car_encrypted,
                "plate" => $carResult->car_licensePlate,
                "brand" => $carResult->car_brand,
                "driver" => $driverResult->user_name . ' ' . $driverResult->user_secName . ' ' . $driverResult->user_lastName,
                "driverId" => $driverResult->user_encrypted,
                "owner" => $ownerResult->user_name . ' ' . $ownerResult->user_secName . ' ' . $ownerResult->user_lastName,
                "ownerId" => $ownerResult->user_encrypted,
                "creationDate" => $lifeResult->life_creationDate,
                "lastModification" => $lifeResult->life_lastModification,
            );
        }

        return response()->json([
            "result" => 1,
            "message" => "Estos Son los Registros",
            "data" => $life,
        ], 200 );
    }

    public function store(Request $request)
    {
        
        $life = $request->all();
        $validator = Validator::make($life, [
            'driverId' => 'required|exists:user,user_encrypted',
            'carId' => 'required|exists:car,car_encrypted',
        ]);

        if($validator->fails()){
            return response()->json([
                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );      
        }
        else{

            $carResult = Car::Where( ["car_encrypted" => $request['carId'] ])->first();

            $driverResult = User::Where( ["user_encrypted" => $request['driverId']] )->first();
            // return response()->json([
            //     "result" => 1,
            //     "message" => $driverResult->user_id,
            // ], 200 );
            $lifeSave = new Life;
            $lifeSave->car_id = $carResult->car_id;
            $lifeSave->user_id = $driverResult->user_id;
            $lifeSave->life_encrypted = md5( $request['lifeId'] . date( "Y-m-d H:i:s" ) );
            $lifeSave->life_creationDate = date('Y-m-d H:i:s'); 
            $lifeSave->save();

            
        }
    }

    public function show($life_id)
    {   
        $lifeResults = Life::where(['life_encrypted'=>$life_id])->get();
        if (count($lifeResults)<1) {
            return response()->json([
                "result" => 1,
                "message" => "Registro no encontrado",
            ], 200 );
        }
        else{
            for( $u = 0; $u < count( $lifeResults ); $u++ ){
                $lifeResult = Life::Where( "life_id", $lifeResults[$u]->life_id )->first();
                $carResult = Car::Where( "car_id", $lifeResult->car_id )->first();
                $driverResult = User::Where( "user_id", $lifeResult->user_id )->first();
                $ownerResult = User::Where( "user_id", $carResult->user_id )->first();
                $result = array(
                    "id" => $lifeResult->life_encrypted,
                    "carId" => $carResult->car_encrypted,
                    "plate" => $carResult->car_licensePlate,
                    "brand" => $carResult->car_brand,
                    "driver" => $driverResult->user_name . ' ' . $driverResult->user_secName . ' ' . $driverResult->user_lastName,
                    "driverId" => $driverResult->user_encrypted,
                    "owner" => $ownerResult->user_name . ' ' . $ownerResult->user_secName . ' ' . $ownerResult->user_lastName,
                    "ownerId" => $ownerResult->user_encrypted,
                    "creationDate" => $lifeResult->life_creationDate,
                    "lastModification" => $lifeResult->life_lastModification,
                );
            }
            return response()->json([
                "result" => 1,
                "message" => "Registro",
                "data" => $result,
            ], 200 );;
        }
    }

    public function update(Request $request, $life_id)
    {    
       
        $life = $request->all();
        $validator = Validator::make($life, [
            'driverId' => 'required|exists:user,user_encrypted',
            'carId' => 'required|exists:car,car_encrypted',
        ]);

        if($validator->fails()){
            return response()->json([
                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );      
        }
        else{
            $carResult = Car::Where( ["car_encrypted" => $request['carId'] ])->first();

            $driverResult = User::Where( ["user_encrypted" => $request['driverId']] )->first();
            
            
            $lifeUpdate =Life::where(['life_encrypted' => $life_id])->first();

            $lifeUpdate->car_id = $carResult->car_id;
            $lifeUpdate->user_id = $driverResult->user_id;
            $lifeUpdate->life_lastModification = date('Y-m-d H:i:s');
            $lifeUpdate->save();

            return response()->json([
                "result" => 1,
                "message" => "Registro actualizado con exito"
            ], 200 );
        }
    }

    public function destroy($life_id)
    {
        $lifeDelete = Life::where(['life_encrypted'=>$life_id])->first();
        $lifeDelete->statu_id = 2;
        $lifeDelete->save();
        return response()->json([
            "result" => 1,
            "message" => "Registro eliminado con exito",
        ], 200 );
    }
}