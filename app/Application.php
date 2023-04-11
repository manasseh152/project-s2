<?php

namespace App;

use Dotenv\Dotenv;

use App\Libraries\Core;


class Application
{
  public static function init()
  {
    session_start();
    self::loadEnv();
    $init = new Core();
  }

  public static function loadEnv()
  {
    $dotenv = Dotenv::createImmutable('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'APP_ENV', 'APP_NAME', 'APP_URL']);
  }
}
