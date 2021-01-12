<?php

namespace App\Http\Controllers;

use App\Token;
use App\User;
use App\UserType;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $user = User::Where([ "statu_id" => 1, "userType_id" => 2])->get();
        $result = array();
        if( count( $user ) > 0 ){
            for( $u = 0; $u < count( $user ); $u++ ){
                $result[] = array(
                    "id" => $user[$u]->user_encrypted,
                    "name" => $user[$u]->user_name,
                    "lastName" => $user[$u]->user_lastName,
                    "lastNameSec" => $user[$u]->user_lastNameSec,
                    "userType" => $user[$u]->userType_id,
                    "nickname" => $user[$u]->user_nickname,
                    "password" => $user[$u]->user_nickname,
                    "cellphone" => $user[$u]->user_cellphone,
                    "email" => $user[$u]->user_email,
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
            'name' => 'required',
            'lastName' => 'required',
            'user_type' => 'required|exists:user_type,userType_encrypted',
            'cellphone' => 'required',
            'nickname' => 'required|unique:user,user_nickname',
            'password' => 'required',
            'email' => 'required',
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
            $user_encrypted = md5( $request['email'].$request['name'] . date( "YmdHis" ) );
            $userSave = new User;
            $userSave->user_name = $request['name'];
            $userSave->user_lastName = $request['lastName']; 
            $userSave->user_lastNameSec = $request->get( "lastNameSec" );
            $userSave->userType_id = $userType_id;
            $userSave->user_cellphone = $request['cellphone'];
            $userSave->user_nickname = $request['nickname']; 
            $userSave->user_password = $request['password'];
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
                    "name" => $user[$u]->user_name,
                    "lastName" => $user[$u]->user_lastName,
                    "lastNameSec" => $user[$u]->user_lastNameSec,
                    "userType" => $user[$u]->userType_id,
                    "nickname" => $user[$u]->user_nickname,
                    "password" => $user[$u]->user_password,
                    "cellphone" => $user[$u]->user_cellphone,
                    "email" => $user[$u]->user_email,
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

    public function update( Request $request, $userId )
    {
        $user = $request->all();

        $validator = Validator::make($user, [
            
            'name' => 'required',
            'lastName' => 'required',
            'userType' => 'required|exists:user_type,userType_id',
            'cellphone' => 'required',
            'email' => 'required',
            'nickname' => 'required',
            'password' => 'required',
        ]);

        if( $validator->fails() ){
            
            return response()->json([

                "result" => 2,
                "message" => $validator->errors(),
            ], 200 );
        }
        else{
            
            $userResult = User::Where([ "user_encrypted" => $userId ])->get();

            User::Where([ "user_id" => $userResult[0]->user_id ])->update([

                "user_name" => $request['name'],
                "user_lastName" => $request['lastName'],
                "user_lastNameSec" => $request->get( "lastNameSec" ),
                "userType_id" => $request->get( "userType" ),
                "user_cellphone" => $request['cellphone'],
                "user_nickname" => $request['nickname'],
                "user_password" => $request['password'],
                "user_email" => $request['email'],
                "user_lastModification" => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                "result" => 1,
                "message" => "Actualización con éxito"
            ], 200 );
        }
    }

    public function validateLogin( Request $request ){
        $messages = [
            'email:required' => 'El email es obligatorio',
            'email:email' => 'El email no está en un formato permitido',
            'password:required' => 'La contraseña es obligatoria', 
        ];
        $validate = Validator::make( $request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], $messages );
        if( $validate->fails() ){
            $errors = $validate->errors()->all();
            return ['result'=> 2, 'message' => $errors ];
        }
        else {
            $user_email = $request->get( "email" );
            $user_password = $request->get( "password" );
            $userResult=User::Where(['user_email'=>$user_email, 'user_password'=>$user_password])->get();
            if (count($userResult)>0) {
                $name = $userResult[0]->user_name;
                $email = $userResult[0]->user_email;
                $tokenSave = new Token;
                $tokenSave->user_id = $userResult[0]->user_id;
                $tokenSave->token_encrypted = md5( $userResult[0]->user_name . date( 'Y-m-d H:i:s' ) );
                $tokenSave->token_creationDate = date('Y-m-d H:i:s'); 
                $tokenSave->save();
                return response()->json([
                    "result" => 1,
                    "message" => "Bienvenido",
                    "data" => array(
                        "token" => $tokenSave->token_encrypted,
                        "name" => $name,
                        "app" => $userResult[0]->user_lastName,
                        "apm" => $userResult[0]->user_lastNameSec,
                        "email" => $user_email
                    )
                ], 200 );
            }
            else {
               return ['result'=> 2, 'message' => 'Datos Incorrectos' ];
            }
        }
    }

    public function Logout( Request $request )
    {
        $token = $request->header( "token" );
        $tokenLogout = Token::Where([ 'token_encrypted' => $token ])->first();
        $tokenLogout->statu_id = 2;
        $tokenLogout->token_lastModification = date('Y-m-d H:i:s');
        $tokenLogout->save();
        return response()->json([
                "result" => 1,
                "message" => "vuelve pronto",
        ], 200 );
    }
}