<?php

namespace App\Http\Controllers;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function addFAQ(Request $request){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $validated=$request->validate([
                'question'=>'required|string',
                'answer'=>'required|string'
            ]);

            FAQ::create([
                'question'=>$request->faqquestion,
                'answer'=>$request->faqanswer
            ]);
            return Redirect()->route('admin-manageFAQ')->with(['success'=>'FAQ created successfully!']);
        }
        else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function editFAQ($id){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $faq=FAQ::find($id);
            return view('admin/admin-editFAQ',compact('faq'));

        }
        else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function updateFAQ(Request $request){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $update=FAQ::find($request->faqid)->update([
                'question'=>$request->faqquestion,
                'answer'=>$request->faqanswer
            ]);
            return Redirect()->route('admin-manageFAQ')->with(['success'=>'FAQ updated successfully!']);
        }

        else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function deleteFAQ($id){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $delete=FAQ::find($id)->delete();

            return Redirect()->route('admin-manageFAQ')->with(['success'=>'FAQ deleted successfully!']);
        }
        
        else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewFAQ(){
        $faqs=FAQ::latest()->paginate(5);

        return view('admin/admin-manageFAQ',compact('faqs'));
    }
    
}
