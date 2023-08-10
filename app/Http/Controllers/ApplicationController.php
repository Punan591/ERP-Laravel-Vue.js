<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        return view('admin.layouts.app',['user' => $user]);
    }
}
