<?php


namespace App\Controllers;

use App\Libraries\Controller;


class Test extends Controller
{
  public function index()
  {
    $data = [
      'title' => "test",
    ];
    // $this->view('homepages/index', $data);
    $this->view('homepages/index', $data);
  }
}
