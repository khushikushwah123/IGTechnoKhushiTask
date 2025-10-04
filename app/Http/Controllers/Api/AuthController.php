<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\{User};
use App\Models\{GenerateUrl,UserClick};
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $insert = new User;
        $insert->email = $request->email;
        $insert->password = Hash::make($request->password);
        $insert->save();

        $token = $insert->createToken('Test')->plainTextToken;
        $insert->token = $token;

        return response()->json(['status'=>true,'message'=>'Registeration Successfully.','data'=>$insert]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        $check = User::where('email',$request->email)->first();
        if(Hash::check($request->password,$check->password)){
            $token = $check->createToken('Test')->plainTextToken;
            $check->token = $token;

            return response()->json(['status'=>true,'message'=>'Login Succcessfully','data'=>$check]);
        }else{
            return response()->json(['status'=>false,'message'=>'InCorrect Password.']);
        }
    }
}
