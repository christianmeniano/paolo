<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin;
use App\Comment;
use App\Post;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{
     

    public function login(){

        // if (!session()->has('id')) {
        //     return redirect()->route('login');
        // }
      
        return view('admin.login');
    }

    public function access(Request $request){
         $admin = Admin::where('email' , '=' , $request->email)->first();
       if ($admin) {
        session(['id' => $admin->id, 'email' => $admin->email]);
        return redirect()->route('admin.index');
       }else
         Session::flash('Errors', 'These credentials do not match our records.');

        return redirect()->route('admin.login');
    }

 

    
}

