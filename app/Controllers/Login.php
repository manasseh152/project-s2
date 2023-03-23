<?php


namespace App\Controllers;

use App\Libraries\Controller;
use App\Models\User;


class Login extends Controller
{
  public function index()
  {
    $data = [
      'title' => "Login",
    ];
    $this->view('loginpages/index', $data);
  }

  public function changepassword()
  {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      header('Location: ' . $_ENV['APP_URL'] . '/login');
      exit;
    }


    $password = $_POST['password'];
    $confirm_password = $_POST['password2'];
    $token = $_POST['token'];
    if (!isset($password) || !isset($confirm_password) || !isset($token)) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    if (empty($password) || empty($confirm_password) || empty($token)) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    if ($password != $confirm_password) {
      $data = [
        'title' => "Change Password",
        'token' => $token,
        'error' => "Password does not match",
      ];
      $this->view('loginpages/changePassword', $data);
      exit;
    }

    $user = User::findUserByToken($token);

    if (!isset($user)) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    $id = $user[0]->id;

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $user = User::update($id, [
      'password' => $hashed,
      'forget_token' => 'null',
    ]);

    header('Location: ' . $_ENV['APP_URL'] . '/login');
  }

  public function change($token)
  {


    if (!isset($token) || empty($token)) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    $user = User::findUserByToken($token);

    if (!isset($user)) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    $expire_date = $user[0]->forget_token_expire;
    $current_date = date("Y-m-d H:i:s");
    if ($current_date > $expire_date) {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    $data = [
      'title' => "Change Password",
      'token' => $token,
    ];
    $this->view('loginpages/changePassword', $data);
  }

  public function forgot()
  {
    $data = [
      'title' => "Forget Password",
    ];
    // $this->view('homepages/index', $data);
    $this->view('loginpages/forgot', $data);
  }

  public function test()
  {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      header('Location: ' . $_ENV['APP_URL'] . '/login/forgot');
      exit;
    }

    $email = $_POST['email'];

    if (empty($email)) {
      $data = [
        'title' => "Forget Password",
        'error' => "Please fill in all fields",
      ];
      $this->view('loginpages/forgot', $data);
      exit;
    }

    $user = User::findUserByUsername($email);

    if (!$user) {
      $data = [
        'title' => "Forget Password",
        'error' => "Email does not exist",
      ];
      $this->view('loginpages/forgot', $data);
      exit;
    }
    $id = $user[0]->id;

    $token = bin2hex(random_bytes(50));

    $user = User::update($id, [
      'forget_token' => $token,
      'forget_token_expire' => date('Y-m-d H:i:s', strtotime('+1 day')),
    ]);


    // return json response
    $this->view('loginpages/changePassword', [
      'title' => 'Change Password',
      'token' => $token,
    ]);
  }
}
