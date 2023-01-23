<?php


namespace App\Controllers;

use App\Libraries\Controller;


class HomePages extends Controller
{

  public function index()
  {
    $data = [
      'title' => "Homepage MVC OOP Framework"
    ];
    // $this->view('homepages/index', $data);
    $this->view('homepages/index', $data);
  }
}
