<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        return Redirect::back();

    }
}
