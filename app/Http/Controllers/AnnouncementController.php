<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function viewAnnouncements(){
        $announcements = Announcement::latest()->paginate('5');
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            return view('admin/admin-manageAnnouncements',compact('announcements'));
        }else if(Auth::check() && Auth::user()->account_type == 'customer'){
            return view('home',compact('announcements'));
        }else{
            return view('guest-home',compact('announcements'));
        }
    }

    public function createAnnouncement(Request $request){
        $validated = $request->validate([
            'announcementContent' => 'required|string',
        ]);

        Announcement::create([
            'announcement_content' => $request->announcementContent,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('admin-manageAnnouncements')->with(['success'=>'Announcement Created Successfully!']);
    }

    //the function below redirects the admin to the 'edit announcement form' for a specific announcement
    public function editAnnouncement(Request $request){
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            $announcement = Announcement::find($request->id);
            return view('admin/admin-editAnnouncement',compact('announcement'));
        }else{
            return view('auth/login');
        }
    }

    //the function below will be the one to update the announcement from the mysql database after form submission..
    public function updateAnnouncement(Request $request){
        $update = Announcement::find($request->announcement_id)->update([
            'announcement_content'=> $request->announcementContent
        ]);
        return Redirect()->route('admin-manageAnnouncements')->with(['success'=>'Announcement Updated Successfully!']);
    }

    public function deleteAnnouncement(Request $request){
        $announcementData = Announcement::find($request->announcement_id);
        $announcementData->delete();
        return Redirect()->route('admin-manageAnnouncements')->with(['success'=>'Announcement Removed Successfully!']);
    }
}
