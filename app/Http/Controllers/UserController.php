<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function viewUserProfile(){ //viewing 'My Profile' page..
        if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('myprofile');
        }else if(Auth::check() && Auth::user()->account_type == 'admin'){
            return view('admin/admin-home');
        }else{
            return view('auth/login');
        }
    }

    public function viewCustomerProfile(){

    }

    public function blockUser(){

    }

    public function unblockUser(){

    }
}
