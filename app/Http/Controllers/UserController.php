<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function viewUserProfile(){ //viewing 'My Profile' page..
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                return view('myprofile');
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else if(Auth::check() && Auth::user()->account_type == 'admin'){
            return view('admin/admin-home');
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewCustomerProfile($userid){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $user = User::find($userid);
            return view('admin/admin-viewCustomer',compact('user'));
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewAllCustomers(){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $users = User::select('id','firstname','lastname','username','account_status','profile_photo_path')
            ->where('account_type','customer')->paginate(12);
            return view('admin/admin-manageCustomers',compact('users'));
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function blockUser($userid){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $update = User::find($userid)->update([
                'account_status' => "blocked"
            ]);

            return Redirect()->back()->with(['success' => 'The customer account has been blocked successfully.']);
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function unblockUser($userid){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $update = User::find($userid)->update([
                'account_status' => "active"
            ]);

            return Redirect()->back()->with(['success' => 'The customer account has been unblocked successfully.']);
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function searchCustomer(Request $request){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $users = User::select('id','firstname','lastname','username','account_status','profile_photo_path')
                    ->whereNotIn('account_type',['admin'])
                    ->where(function ($query) use ($request){
                    $query->where('firstname','LIKE', '%'.$request->searchcustomer.'%')
                    ->orWhere('lastname','LIKE', '%'.$request->searchcustomer.'%')
                    ->orWhere('username','LIKE', '%'.$request->searchcustomer.'%')
                    ->orWhere('email','LIKE', '%'.$request->searchcustomer.'%');
                    })->paginate(12);
            return view('admin/admin-searchcustomers',compact('users'));
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }
}
