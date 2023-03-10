<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view(
            'auth/login',
            ['config' => config('auth')]
        );
    }

    public function register()
    {
        return view('auth/register');
    }
    public function create()
    {
        return view('/admin/detail');
    }
    public function user()
    {
        return view('user/index');
    }
}
