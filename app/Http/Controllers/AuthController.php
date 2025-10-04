<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{User};
use App\Models\{GenerateUrl,UserClick};
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if($request->submit){
            $request->validate([
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6'
            ]);

            $insert = new User;
            $insert->email = $request->email;
            $insert->password = Hash::make($request->password);
            $insert->save();

            Auth::login($insert);
            return redirect('dashboard-page')->with('success','Register Successfully');
        }
        return view('register_form');
    }

    public function login(Request $request)
    {
        if($request->submit){
            $request->validate([
                'email' => 'required|exists:users,email',
                'password' => 'required'
            ]);

            $check = User::where('email',$request->email)->first();
            if(Hash::check($request->password,$check->password)){
                Auth::login($check);
                return redirect('dashboard-page')->with('success','Login Successfully');
            }else{
                return back()->with('success','Incorrect Password.');
            }
        }
        return view('login_form');
    }

    public function dashboard_page(Request $request){
        $urls = GenerateUrl::where('user_id',Auth::user()->id)->latest()->get();
        return view('dashboard.index',compact('urls'));
    }

    public function dashboard_show(Request $request,$url)
    {
        $urls = GenerateUrl::where('id',base64_decode($url))->first();
        $on_click = UserClick::where('generate_url_id',base64_decode($url))->latest()->get();
        return view('dashboard.show',compact('on_click','urls'));
    }

    public function dashboard_edit(Request $request,$url){
        $urls = GenerateUrl::where('id',base64_decode($url))->first();
        if($request->submit){
            $request->validate([
                'title' => 'required',
                'url' => 'required',
                'expire_on' => 'required',
            ]);

            $urls->title = $request->title;
            $urls->url = $request->url;
            $urls->expiration = $request->expire_on;
            $urls->save();

            return redirect('dashboard-page')->with('success','Edit Successfully.');
        }
        return view('dashboard.edit',compact('urls'));
    }

    public function dashboard_delete(Request $request,$url)
    {
        $urls = GenerateUrl::where('id',base64_decode($url))->delete();
        $on_click = UserClick::where('generate_url_id',base64_decode($url))->latest()->delete();

        return redirect('dashboard-page')->with('success','Delete Successfully.');
    }
}
