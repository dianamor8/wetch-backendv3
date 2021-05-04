<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'            
        ], ['email.unique'=> 'Este usuario ya se encuentra registrado']);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;        
        $url = $request['url'];//'http://localhost:4200/change-password';

        try {
            Mail::to($request['email'])->send(new Register($token, $url, $user));
            return response()->json([                
                'message' => 'Verifique su cuenta accediendo al correo electrónico'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([                
                'message' => 'Ocurrió un error al intentar enviar la información. Verifique su correo electrónico'
            ], 401);
        }
        



        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user 
        ], 200);

    }

    public function login (Request $request){
        try {
            if(!Auth::attempt($request->only('email', 'password'))){
                return response()->json([
                    'message' => 'Credenciales de acceso no válido'
                ], 401);
            }
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 200);    
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th
            ], 401);
        } 
        
    }


     public function userInfo (Request $request){
        $user = User::where('email', $request['email'])->first();

        if($user){
            return response()->json([                
                'user' => $user
            ], 200);
        }else{
            return response()->json([                
                'user' => null
            ], 200);
        }
     }

     public function resetPassword (Request $request){         

        $user = User::where('email', $request['email'])->first();

        if($user){
            $user->tokens()->delete();
            $token = $user->createToken('reset-password')->plainTextToken;
            $url = $request['url'];//'http://localhost:4200/change-password';
            try {
                Mail::to($request['email'])->send(new ResetPassword($token, $url, $user));
                return response()->json([                
                    'message' => 'La información para reestablecer su contraseña se ha enviado a su correo electrónico'
                ], 200);    
            } catch (\Throwable $th) {                                
                return response()->json([                
                    'message' => 'Ocurrió un error al intentar enviar la información. Contáctese con el administrador'
                ], 401);
            }

        }else{
            return response()->json([                
                'error' => 'Usuario no encontrado'
            ], 401);
        }

        
     }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([                
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    public function userDetail(Request $request){
        return $request->user();
    }


    public function verifyToken(Request $request){

        try {
            $now = new DateTime();        
            $token = $request->user()->currentAccessToken();        
            $token_create_at = new DateTime($token->created_at);
            $token_expires_at= $token_create_at->modify('+1 day');
    
            if($now<$token_expires_at){
                return response()->json([                
                    'valid' => true
                ], 200);
            }else{
                return response()->json([                
                    'error' => 'Esta petición ha expirado, intente reestablecer nuevamente'
                ], 401);
            }
    
            return $request->user()->currentAccessToken();    
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([                
                'error' => 'La información de este correo ya fue utilizada.'
            ], 401);
        }         
    }


    public function changePassword(Request $request){

        try {
            $validatedData = $request->validate([
                'password' => 'required|string|min:8'            
            ]);
    
            $user = $request->user();
            $user->password = Hash::make($validatedData['password']);
            $user->save();
    
            $user->tokens()->delete();                
            return response()->json([            
                'message' => 'Contraseña cambiada con éxito'
            ], 200); 

        } catch (\Throwable $th) {
            return response()->json([            
                'error' => 'Ocurrió un error al cambiar la contraseña'
            ], 401); 
        }        
    }


    public function validateAccount(Request $request){
        $user = $request->user();
        $user->email_verified_at = new DateTime();
        $user->save();
        $user->tokens()->delete();         
        return response()->json([
            'message' => 'Cuenta validada con éxito, inicie sesión',                
        ], 200); 
    }
    
    
}
