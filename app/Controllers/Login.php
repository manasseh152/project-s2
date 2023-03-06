<?php


namespace App\Controllers;

use App\Libraries\Controller;


class Login extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Login",
    ];
    $this->view('loginpages/index', $data);
  }

  public function forgot()
  {
    $data = [
      'title' => "Forget Password",
    ];
    // $this->view('homepages/index', $data);
    $this->view('loginpages/forgot', $data);
  }
}
