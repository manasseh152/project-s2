<?php

namespace App\Controllers;

use App\Libraries\Controller;
use App\Models\User;


class Register extends Controller
{

  public function index()
  {
    $data = [
      'title' => "Register",
    ];
    // $this->view('homepages/index', $data);
    $this->view('registerpages/index', $data);
  }

  public function register()
  {
    if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
      header('Location: ' . $_ENV['APP_URL'] . '/register');
      exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['confirmPassword'];

    if (empty($email) || empty($password) || empty($password2)) {
      $data = [
        'title' => "Register",
        'error' => "Please fill in all fields",
      ];
      $this->view('registerpages/index', $data);
      exit;
    }

    if ($password !== $password2) {
      $data = [
        'title' => "Register",
        'error' => "Passwords do not match",
      ];
      $this->view('registerpages/index', $data);
      exit;
    }

    $user = User::findUserByEmail($email);

    if ($user) {
      $data = [
        'title' => "Register",
        'error' => "Username already exists",
      ];
      $this->view('registerpages/index', $data);
      exit;
    }

    $user = User::createUser($email, $password);

    if ($user) {
      header('Location: ' . $_ENV['APP_URL'] . '/login');
      exit;
    } else {
      $data = [
        'title' => "Register",
        'error' => "Something went wrong",
      ];
      $this->view('registerpages/index', $data);
      exit;
    }
  }
}
