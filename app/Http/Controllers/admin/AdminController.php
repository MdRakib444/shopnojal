<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){

    	return view('admin.login');
    }

    public function authenticate(Request $Request){
    	$validator = Validator::make($Request->all(),[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if($validator->passes()){

            if(Auth::guard('admin')->attempt(['email'=> $Request->email, 'password'=> $Request->password], $Request->get('remember'))){

                $admin = Auth::guard('admin')->User();

                if($admin->role == 2){
                    return redirect()->route('admin.dashboard');

                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'Either Email//Passwordis incorrect');
                }
                
            }else{
                return redirect()->route('admin.login')->with('error', 'Either Email/Password is incorrect');
            }
    	}else{
    		return redirect()->route('admin.login')->withErrors($validator)->withInput($Request->only('email'));
    	}
    }
}
