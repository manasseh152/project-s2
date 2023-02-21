<?php


namespace App\Controllers;

use App\Libraries\Controller;


class RegisterPages extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Register",
    ];
    // $this->view('homepages/index', $data);
    $this->view('registerpages/index', $data);
  }
}
