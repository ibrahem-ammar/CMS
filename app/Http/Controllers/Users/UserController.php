<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {

        $posts = auth()->user()->posts()->with(['media','category'])
        ->withCount('comments')
        ->orderBy('id','desc')->paginate(10);


        // dd($posts);
        return view('site.user.index',compact('posts'));
    }

    public function edit()
    {
        return view('site.user.edit');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required','unique:users,mobile,'.auth()->id(),'numeric','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->id()],
            'image' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],
            'bio' => ['nullable', 'string', 'max:1000','min:10'],
            'receive_email' => ['required','boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        // dd($request->all());

        if ($image = $request->file('image')) {
            if (auth()->user()->image) {
                if (File::exists('assets/users/'. auth()->user()->image)) {
                    unlink('assets/users/'. auth()->user()->image);
                }
            }

            $image_name = Str::slug(auth()->user()->username) . '.' . $image->getClientOriginalExtension();

            $path = public_path('assets/users/'.$image_name);

            Image::make($image->getRealPath())->resize(300,300,function($constraint)
            {
                $constraint->aspectRatio();
            })->save($path,100);

        }

        $updated_user = auth()->user()->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'bio' => Purify::clean($request->bio),
            'receive_email' => $request->receive_email,
            'image'=> isset($image_name) ? $image_name : null
        ]);

        if ($updated_user) {
            return redirect()->route('dashboard')->with([
                'message' => 'Information Updated Successfully',
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Unable To Update Information',
            'type' => 'danger'
        ]);
    }

    public function destroy_avatar()
    {
        if (auth()->user()->image) {
            if (File::exists('assets/users/'. auth()->user()->image)) {
                unlink('assets/users/'. auth()->user()->image);
            }

            auth()->user()->update(['image' => null]);

            return true;
        }
        return false;
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required','min:8'],
            'password' => ['required','confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Hash::check($request->current_password,auth()->user()->password)) {
            $updated_password = auth()->user()->update(['password'=>bcrypt($request->password)]);

            if ($updated_password) {
                return redirect()->route('dashboard')->with([
                    'message' => 'Password Updated Successfully',
                    'type' => 'success'
                ]);
            }

        }

        return redirect()->back()->with([
            'message' => 'Unable To Change Password',
            'type' => 'danger'
        ]);

    }
}
