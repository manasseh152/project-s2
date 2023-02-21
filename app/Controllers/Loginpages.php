<?php


namespace App\Controllers;

use App\Libraries\Controller;


class LoginPages extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Login",
    ];
    // $this->view('homepages/index', $data);
    $this->view('loginpages/index', $data);
  }
}
