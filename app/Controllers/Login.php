<?php


namespace App\Controllers;

use App\Libraries\Controller;
use App\Models\User;


class Login extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Login"
    ];
    $this->view('loginpages/index', $data);
  }

  public function login()
  {
    if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
      header('Location: ' . $_ENV['APP_URL'] . '/login');
      exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for empty fields
    if (empty($email) || empty($password)) {
      $data = [
        'title' => "Login",
        'error' => "Please fill in all fields",
      ];
      $this->view('loginpages/index', $data);
      exit;
    }

    $user = User::findUserByEmail($email);

    if (!$user) {
      $data = [
        'title' => "Login",
        'error' => "Username does not exist",
      ];
      $this->view('loginpages/index', $data);
      exit;
    }

    if (!password_verify($password, $user->password)) {
      $data = [
        'title' => "Login",
        'error' => "Incorrect password",
      ];
      $this->view('loginpages/index', $data);
      exit;
    }

    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;

    header('Location: ' . $_ENV['APP_URL'] . '/');
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
