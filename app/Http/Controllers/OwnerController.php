<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserType;
use Validator;

class OwnerController extends Controller
{
    public function index()
    {
        $user = User::Where([ "statu_id" => 1, "userType_id" => 2])->get();
        $result = array();
        if( count( $user ) > 0 ){
            for( $u = 0; $u < count( $user ); $u++ ){
                $result[] = array(
                    "id" => $user[$u]->user_encrypted,
                    "userType" => $user[$u]->userType_id,
                    "identity" => $user[$u]->user_identity,
                    "name" => $user[$u]->user_name,
                    "secName" => $user[$u]->user_secName,
                    "lastName" => $user[$u]->user_lastName,
                    "cellphone" => $user[$u]->user_cellphone,
                    "city" => $user[$u]->user_city,
                    "password" => $user[$u]->user_password,
                    "email" => $user[$u]->user_email,
                    "address" => $user[$u]->user_address,
                    "creationDate" => $user[$u]->user_creationDate
                );
            }
        }
        return response()->json([
            "result" => 1,
            "message" => "Estos Son los Registros",
            "data" => $result,
        ], 200 );
    }

    public function store(Request $request)
    {
        $user = $request->all();
        $validator = Validator::make($user, [
            'identity' => 'required', 
            'name' => 'required',
            'lastName' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cellphone' => 'required',
            'email' => 'required',
            'user_type' => 'required|exists:user_type,userType_encrypted',
            
        ]);   
        if($validator->fails()){
            return response()->json([
                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );
        }
        else{
            $userTypeResult = UserType::Where([ "userType_encrypted" => $request['user_type'] ])->get();
            $userType_id = $userTypeResult[0]->userType_id;
            $user_encrypted = md5( $request['email'].$request['name'].date( "YmdHis" ) );
            $userSave = new User;
            $userSave->userType_id = $userType_id;
            $userSave->user_identity = $request['identity']; 
            $userSave->user_name = $request['name'];
            $userSave->user_secName = $request->get( "secName" );
            $userSave->user_lastName = $request['lastName']; 
            $userSave->user_cellphone = $request['cellphone'];
            $userSave->user_address = $request['address'];
            $userSave->user_city = $request['city'];
            $userSave->user_email = $request['email']; 
            $userSave->user_encrypted = $user_encrypted; 
            $userSave->user_creationDate = date('Y-m-d H:i:s'); 
            $userSave->Save();

            return response()->json([
                "result" => 1,
                "message" => "Registro con éxito",
                "id" => $user_encrypted
            ], 200 );
        }
    }

    public function show($user_id)
    {
        $user = User::where(['user_encrypted'=>$user_id])->get();  
        if( count( $user ) == 0 ){
            return response()->json([
                "result" => 1,
                "message" => "Usuario no encontrado"
            ], 200 );
        }
        else{
            for( $u = 0; $u < count( $user ); $u++ ){
                $result = array(
                    "id" => $user[$u]->user_encrypted,
                    "userType" => $user[$u]->userType_id,
                    "identity" => $user[$u]->user_identity,
                    "name" => $user[$u]->user_name,
                    "secName" => $user[$u]->user_secName,
                    "lastName" => $user[$u]->user_lastName,
                    "cellphone" => $user[$u]->user_cellphone,
                    "city" => $user[$u]->user_city,
                    "password" => $user[$u]->user_password,
                    "email" => $user[$u]->user_email,
                    "address" => $user[$u]->user_address,
                    "creationDate" => $user[$u]->user_creationDate
                );
            }
            return response()->json([
                "result" => 1,
                "message" => "Deatlle de Usuario",
                "data" => $result
            ], 200 );;
        }
    }

    public function update( Request $request, $userId )
    {
        $user = $request->all();

        $validator = Validator::make($user, [
            'identity' => 'required', 
            'name' => 'required',
            'lastName' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cellphone' => 'required',
            'email' => 'required',
            'user_type' => 'required|exists:user_type,userType_encrypted',
        ]);

        if( $validator->fails() ){
            
            return response()->json([

                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );
        }
        else{
            $userTypeResult = UserType::Where([ "userType_encrypted" => $request['user_type'] ])->get();
            $userType_id = $userTypeResult[0]->userType_id;
            $userResult = User::Where([ "user_encrypted" => $userId ])->get();

            User::Where([ "user_id" => $userResult[0]->user_id ])->update([
                "userType_id" => $userType_id,
                "user_identity" => $request['identity'],
                "user_name" => $request['name'],

                "user_secName" => $request['secName'],

                "user_lastName" => $request['lastName'],
                "user_cellphone" => $request['cellphone'],
                "user_address" => $request['address'],
                "user_city" => $request['city'],
                "user_email" => $request['email'],
                "user_lastModification" => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                "result" => 1,
                "message" => "Actualización con éxito"
            ], 200 );
        }
    }

    public function destroy($user_id)
    {
        $userDelete = User::where(['user_encrypted'=>$user_id])->first();
        $userDelete->statu_id = 2;
        $userDelete->save();
        return response()->json([
            "result" => 1,
            "message" => "Registro eliminado con exito",
        ], 200 );
    }
}
