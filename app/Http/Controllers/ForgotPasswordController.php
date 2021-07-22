<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('admin.resetPasswordEmail');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('admin.email', ['token' => $token], function($message) use ($request){
            $message->to($request->email);
            $message->subject('Redefinição de senha');
        });

        return back()->with('message', 'As instruções de redefinição de senha foram enviadas para o seu email');
    }

    public function resetPasswordForm($token)
    {
        return view('admin.resetPasswordForm', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_rests')
                            ->where([
                                'email' => $request->email,
                                'toke,' => $request->token
                            ])->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'token inválido');
        }

        $user = User::where('email', $request->email)
                            ->update(['password' => Hash::make($request->password)]);
        
        DB::table('password_rests')->where(['email' => $request->email])->delete();
        
        return redirect('/admin');
    }
}
