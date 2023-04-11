<?php

namespace App\Controllers;

use App\Libraries\BaseController;
use App\Models\User;

class Auth extends BaseController
{
  private User $user;

  public function __construct()
  {
    $this->user = User::getInstance();
  }

  public function register(): void
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $this->setData([
          'title' => 'Register',
        ]);
        $this->view('auth/register');
        break;
      case 'POST':
        try {
          if ($this->user->insert($_POST['email'], $_POST['password'])) {
            $this->setData([
              'title' => 'Register Successfull',
              'messages' => [
                'You have successfully registered. You will be redirected to the login page in 2 seconds.',
              ],
            ]);
            $this->view('layouts/msg');
            header('Refresh: 2; url=' . $_ENV['APP_URL'] . '/auth/login');
          } else {
            $this->setData([
              'title' => 'Register',
              'error' => 'Something went wrong. Please try again.',
            ]);
            $this->view('auth/register');
          }
        } catch (\Exception $e) {
          $this->setData([
            'title' => 'Register',
            'messages' => [
              $e->getMessage(),
              'You will be redirected to the register page in 2 seconds.',
            ],
          ]);
          $this->view('layouts/msg');
          header('Refresh: 2; url=' . $_ENV['APP_URL'] . '/auth/register');
        }
        break;
    }
  }
}
