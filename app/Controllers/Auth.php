<?php

namespace App\Controllers;

use App\Libraries\Controller;

class Auth extends Controller
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }
  public function login()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'POST':
        $user = [
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ];

        try {
          $user = $this->userModel->getUserByEmail($user['email']);
          if (password_verify($user['password'], $user['password'])) {
            header('location: ' . URLROOT . '/');
          }

          $data = [
            'title' => 'Login',
            'error' => 'Email or password is incorrect'
          ];

          header('location: ' . URLROOT . '/auth/login');
          $this->view('auth/login', $data);
        } catch (\Exception $e) {
          $data = [
            'title' => 'Login',
            'error' => 'Email or password is incorrect'
          ];

          $this->view('auth/login', $data);
        }

        break;
      case 'GET':
        $data = [
          'title' => 'Login'
        ];
        $this->view('auth/login', $data);
        break;
      default:
        header('location: ' . URLROOT . '/');
        break;
    }
  }
  public function register()
  {
    $data = [
      'title' => 'Register'
    ];
    $this->view('auth/register', $data);
  }
}
