<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(!auth()->attempt($request->only('email','password'))){
            return back()->with('status','Invalid login credentials');
        }
        return   redirect()->Route('dashboard');
        
        // dd("ok");
    }
}
