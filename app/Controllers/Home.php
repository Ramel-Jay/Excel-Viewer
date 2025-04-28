<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->has('loggedInUser')) {
            return redirect()->to('auth/login');
        }
    }
}
