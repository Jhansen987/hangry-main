<?php

namespace App\Http\Controllers;
use App\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function addFAQ(Request $request){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $errorMessages = [
                'faqquestion.unique' => 'This question already exists.'
            ];

            $validated=$request->validate([
                'faqquestion'=>'required|string|unique:faq,question',
                'faqanswer'=>'required|string'
            ],$errorMessages);

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
            $faq = FAQ::find($request->faqid);

            if($request->faqquestion == $faq->question){
                /*do nothing and move on... */
            }else{
                $errorMessages = [
                    'faqquestion.unique' => 'This question already exists.'
                ];
    
                $validated=$request->validate([
                    'faqquestion'=>'required|string|unique:faq,question',
                    'faqanswer'=>'required|string'
                ],$errorMessages);
            }

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
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $faqs=FAQ::latest()->paginate(5);
            return view('admin/admin-manageFAQ',compact('faqs'));
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function searchFAQ(Request $request){
        if(Auth::check() && Auth::user()->account_type=='admin'){
            $faqs = FAQ::where('question', 'LIKE', '%'.$request->searchfaq.'%')->latest()->paginate(5);
            return view('admin/admin-searchFAQ',compact('faqs'));
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }
    
}
