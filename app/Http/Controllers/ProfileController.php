<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show() {
        return view('userProfile');
    }

    public function switch() {
        $user = auth()->user();
        $user->is_admin = ($user->is_admin + 1) % 2;
        $user->save();

        return redirect()->route('profileShow');
    }
}
