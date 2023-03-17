<?php


namespace App\Controllers;

use App\Libraries\Controller;

class Menu extends Controller
{
  public function index()
  {
    $data = [
        
      'title' => "Menu",
    ];
    
    $this->view('menupages/index', $data);
  }
}