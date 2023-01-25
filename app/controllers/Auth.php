<?php

namespace App\Controllers;

use App\Libraries\Controller;

class Auth extends Controller
{
  public function login()
  {
    $data = [
      'title' => 'Login'
    ];
    $this->view('auth/login', $data);
  }
  public function register()
  {
    $data = [
      'title' => 'Register'
    ];
    $this->view('auth/register', $data);
  }
}
