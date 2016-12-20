<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProfilesController extends Controller
{
    public function index($slug){

       $user = User::where('slug', $slug)->firstOrFail();

        return view('profiles.profile')->with('user', $user);
    }


    public function edit(){
        return view('profiles.edit')->with('info', Auth::user()->profile);
    }

    /**
    *  Method to update user's profile
    */
    public function update(Request $r){

        $this->validate($r, [
            'location' => 'required',
            'about' => 'required|max:255'
        ]);

        Auth::user()->profile()->update([
           'location' => $r->location,
            'about' => $r->about
        ]);

        if($r->hasFile('avatar')){
            Auth::user()->update([
                'avatar' => $r->avatar->store('storage/defaults/avatars')
            ]);
        }

        Session::flash('success', 'Your profile has been updated successfully');
         
        return redirect()->back();
        


    }

}
