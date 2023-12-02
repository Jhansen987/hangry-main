<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function viewUserProfile(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
        $user = User::find(Auth::user()->id);
        return view('myprofile',compact('user'));
        }else if(Auth::check() && Auth::user()->account_type == 'admin'){
            $user = User::find(Auth::user()->id);
            return view('admin/admin-home',compact('user'));
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
