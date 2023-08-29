<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate ([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)){
            $user = User::where('email',$request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'User logged successfully',
                'data' => $user, 
                'token' => $user->createToken('API TOKEN')->plainTextToken,
            ], 200);

        }
        
        return response()->json([
            'status' => false,
            'message' => 'The email or password are incorrect'
        ], 404);
       

        
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out'
        ],200);
    }

    public function forgetPassword(Request $request ){

        $request->validate([
            'email' => 'required|string|email'
        ]);

        $user = User::where('email',$request->email)->get();

        if(count($user)){
            $token = Str::random(40);
            $domain = URL::to('/');
            $url = $domain.'/reset-password?token='.$token;

            $data['url'] = $url;
            $data['email'] = $request->email; 
            $data['title'] = "Password Reset";
            $data['body'] = "Please click on below link to reset your password";

            Mail::send('forgetPasswordMail',['data'=>$data], function($message) use($data){
                $message->to($data['email'])->subject($data['title']);
            });

            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            PasswordReset::updateOrCreate(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $datetime
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Please check your email to reset your password'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'message' =>  'User not found'
            ]);
        }
    }
}
