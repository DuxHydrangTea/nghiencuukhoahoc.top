<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Member;

class AuthController extends Controller
{
    //
    public function login(){
        return view('client.auth.login');
    }

    public function logout(){
        Auth::guard('members')->logout();
        return redirect(route('home'));
    }

    public function handleLogin(Request $request){
        if(Auth::guard('members')->attempt([ 'email' => $request->input('email'), 'password' => $request->input('password')])){
            return response([
                'success' => true,
                'message' => 'Đăng nhập thành công!',
            ], 200);
        }else{
            return response([
                'success' => false,
                'message' => 'Đăng nhập thất bại!',
            ], 200);
        }
    }

    public function handleRegister(Request $request){
        $member = Member::create($request->all());
        if($member){
            return response([
                'message' => 'Tạo tài khoản thành công!',
            ], 200);
        }else{
            return response([
                'message' => 'Tạo tài khoản thất bại!',
            ], 500);
        }
    }
}
