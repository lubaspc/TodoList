<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Response\UserWS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('user',$request->user)->first();
        if ($user == null){
            return response()->json([
                'success' => false,
                'message' => 'El usuario no existe',
                'data' => null
            ]);
        }
        if (!Hash::check($request->password,$user->password)){
            return response()->json([
                'success' => false,
                'message' => 'La contraseña es incorrecta',
                'data' => null
            ]);
        }
        $user->api_token = Hash::make($user->password.$user->name);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Completo',
            'data' => new UserWS($user)
        ]);
    }

    public function register(Request $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($user->password);
         if (!$user->save()){
             return response()->json([
                 'success' => false,
                 'message' => 'Occurrio un error intentalo mas tarde'
             ]);
         }
         return response()->json([
             'success' => true,
             'message' => ''
         ]);
    }

}
