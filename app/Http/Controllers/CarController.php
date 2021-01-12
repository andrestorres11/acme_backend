<?php
namespace App\Http\Controllers;

use App\Car;
use App\User;
use Illuminate\Http\Request;
use Validator;

class CarController extends Controller
{
    public function index()
    {
        $carResults = Car::Where("statu_id", 1)->get();
        $car = array();

        for( $l = 0; $l < count( $carResults ); $l++ ){
            
            $carResult = Car::Where( "car_id", $carResults[$l]->car_id )->first();

            $ownerResult = User::Where( "user_id", $carResult->user_id )->get();
            $car[] = array(
                "id" => $carResult->car_encrypted,
                "plate" => $carResult->car_licensePlate,
                "brand" => $carResult->car_brand,
                "color" => $carResult->car_color,
                "type" => $carResult->car_type,
                "owner" => $ownerResult[0]->user_name . ' ' . $ownerResult[0]->user_secName . ' ' . $ownerResult[0]->user_lastName,
                "ownerId" => $ownerResult[0]->user_encrypted,
                "creationDate" => $carResult->car_creationDate,
                "lastModification" => $carResult->car_lastModification,
            );
        }

        return response()->json([
            "result" => 1,
            "message" => "Estos Son los Registros",
            "data" => $car,
        ], 200 );
    }

    public function store(Request $request)
    {
        $car = $request->all();
        $validator = Validator::make($car, [
            'ownerId' => 'required|exists:user,user_encrypted',
            'plate' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );      
        }
        else{

            
            $ownerResult = User::Where( "user_encrypted", $request['ownerId'] )->get();
            $carSave = new Car;
            $carSave->user_id = $ownerResult[0]->user_id;
            $carSave->car_licensePlate = $request['plate'];
            $carSave->car_brand = $request['brand'];
            $carSave->car_color = $request['color'];
            $carSave->car_type = $request['type'];
            $carSave->car_encrypted = md5( $request['carId'] . date( "Y-m-d H:i:s" ) );
            $carSave->car_creationDate = date('Y-m-d H:i:s'); 
            $carSave->save();

            return response()->json([
                "result" => 1,
                "message" => "Registro con éxito",
                "id" => $carSave->car_id,
            ], 200 );
        }
    }

    public function show($car_id)
    {   
        $car = Car::where(['car_encrypted'=>$car_id])->get();
        if (count($car)<1) {
            return response()->json([
                "result" => 1,
                "message" => "Registro no encontrado",
            ], 200 );
        }
        else{
            for( $u = 0; $u < count( $car ); $u++ ){
                $ownerResult = User::Where( "user_id", $car[$u]->user_id )->get();
                $result = array(
                    "id" => $car[$u]->car_encrypted,
                    "plate" => $car[$u]->car_licensePlate,
                    "brand" => $car[$u]->car_brand,
                    "color" => $car[$u]->car_color,
                    "type" => $car[$u]->car_type,
                    "owner" => $ownerResult[0]->user_name . ' ' . $ownerResult[0]->user_secName . ' ' . $ownerResult[0]->user_lastName,
                    "ownerId" => $ownerResult[0]->user_encrypted,
                    "creationDate" => $car[$u]->car_creationDate,
                    "lastModification" => $car[$u]->car_lastModification,
                );
            }
            return response()->json([
                "result" => 1,
                "message" => "Registro",
                "data" => $result,
            ], 200 );;
        }
    }

    public function update(Request $request, $car_id)
    {       
        $car = $request->all();
        $validator = Validator::make($car, [
            'ownerId' => 'required|exists:user,user_encrypted',
            'plate' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );      
        }
        else{
            $ownerResult = User::Where( ['user_encrypted' => $request['ownerId']] )->get();
            $carUpdate = Car::where(['car_encrypted' => $car_id])->first();
            $carUpdate->user_id = $ownerResult[0]->user_id;
            $carUpdate->car_licensePlate = $request['plate'];
            $carUpdate->car_brand = $request['brand'];
            $carUpdate->car_color = $request['color'];
            $carUpdate->car_type = $request['type'];
            $carUpdate->car_lastModification = date('Y-m-d H:i:s');
            $carUpdate->save();

            return response()->json([
                "result" => 1,
                "message" => "Registro actualizado con exito"
            ], 200 );
        }
    }

    public function destroy($car_id)
    {
        $carDelete = Car::where(['car_encrypted'=>$car_id])->first();
        $carDelete->statu_id = 2;
        $carDelete->save();
        return response()->json([
            "result" => 1,
            "message" => "Registro eliminado con exito",
        ], 200 );
    }
}

