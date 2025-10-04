<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{GenerateUrl,UserClick};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GenerateUrlController extends Controller
{
    public function create(Request $request){
        if($request->submit){
            $request->validate([
                'title' => 'required',
                'url' => 'required',
                'expire_on' => 'required',
            ]);

            $base_path = Str::random(5);

            $insert = new GenerateUrl;
            $insert->user_id = Auth::user()->id;
            $insert->base_path = $base_path;
            $insert->title = $request->title;
            $insert->url = $request->url;
            $insert->expiration = $request->expire_on;
            $insert->save();

            return redirect()->route('generate_url.success',$base_path);
        }
        return view('generate_url.create');
    }

    public function success(Request $request,$base_path){
        $check = GenerateUrl::where('base_path',$base_path)->first();
        return view('generate_url.success',compact('check'));
    }

    public function exit(Request $request,$base_path){
        $check = GenerateUrl::where('base_path',$base_path)->first();
        // if($check) return back()->with('danger','Incorrect Url');

        $insert = new UserClick;
        $insert->generate_url_id = $check->id;
        $insert->ip = $request->ip();
        $insert->save();

        return view('generate_url.exit',['user_click'=>$insert,'generate_url'=>$check]);
    }
}

