<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function contact()
    {
        return view('site.contact');
    }

    public function docontact(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'subject' => 'required',
            'massage' => 'required|min:10',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Contact::create($request->all());

        return redirect()->back()->with([
            'massage' => 'email send successfully',
            'type' => 'danger'
        ]);
    }

    public function page($slug)
    {

        // dd($slug);
        $page = Page::whereSlug($slug)->whereType('page')->whereStatus(1)->with(['user','media'])->first();

        if ($page) {
            return view('site.page',compact('page'));
        }else{
            return redirect()->route('posts.index')->with([
                'massage' => 'something wrong happend',
                'type' => 'danger'
            ]);
        }




    }
}
