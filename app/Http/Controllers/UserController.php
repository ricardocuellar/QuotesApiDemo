<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resetPasswordLoad(Request $request){
        $resetData = PasswordReset::where('token',$request->token)->first();
        
        if(isset($request->token) && $resetData != null){
            $user = User::where('email', $resetData->email )->first();
            return view('resetPassword', compact('user'));
        }

        return abort('404');
    }

    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);

        $user->save();

        PasswordReset::where('email',$user->email)->delete();

        return "<p>Your password has been updated successfully </p>"; 
    }
}
