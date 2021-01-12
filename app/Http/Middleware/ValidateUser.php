<?php



namespace App\Http\Middleware;



use App\Token;

use Closure;

use Illuminate\Support\Facades\Log;



class ValidateUser

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)
    {

        $token = $request->header( "token" );

        if( empty( $token ) ){

            return response()->json([

                "result" => 2,

                "message" => "Ud no es un usuario logueado"

            ], 401);
        }
        else{

            $token_result = Token::where([ "token_encrypted" => $token, "statu_id" => 1 ]);

            if( $token_result->count() == 0 ){

                return response()->json([

                    "result" => 2,

                    "message" => "el token no existe o ya expiro"

                ], 401);

            }

        }



        return $next( $request );

    }

}