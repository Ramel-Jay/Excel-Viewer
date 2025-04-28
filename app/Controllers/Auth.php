<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Hash;
use App\Models\UserModel;

class Auth extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function register(){
        return view('auth/register');
    }

    public function registerUser()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|max_length[20]',
            'confirmPassword' => 'required|min_length[5]|max_length[20]|matches[password]'
        ]);

        if (!$validated) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword'); 


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        $userModel = new UserModel();

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ];


        $query = $userModel->save($data);

        if (!$query) {
            return redirect()->back()->with('fail', 'Saving user failed');
        } else {
            return redirect()->to('auth/login')->with('success', 'Registered User Successfully');
        }
    }

    public function loginUser()
    {
        $validated = $this->validate([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[5]|max_length[20]',
        ]);

        if (!$validated) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $userInfo  = $userModel->where('email', $email)->first();

        if (!$userInfo || !password_verify($password, $userInfo['password'])) {
            session()->setFlashData('fail', 'Incorrect email or password');
            return redirect()->to('auth/login');
        }

        // Store only user ID in session
        session()->set('loggedInUser', $userInfo['id']);

        return redirect()->to('/dashboard');
    }
    
}
