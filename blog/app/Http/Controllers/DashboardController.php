<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index(){
        // Mail::to($user)->send(new PostLiked());
        return view('dashboard');
    }
}
