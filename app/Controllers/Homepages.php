<?php


namespace App\Controllers;

use App\Libraries\Controller;


class HomePages extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Home",
    ];
    // $this->view('homepages/index', $data);
    $this->view('homepages/index', $data);
  }
}
