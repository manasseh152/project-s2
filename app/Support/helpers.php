<?php

if (!function_exists("app")) {
  /**
   * This function will try and get the class from the container
   * @param $id
   * @return mixed|object|string|null
   */
  function app($id): mixed
  {
    try {
      return \App\Libraries\Core::$container->get($id);
    } catch (Exception | \App\Exceptions\Container\ContainerException $exception) {
      error($exception);
    }
  }
}

if (!function_exists("error")) {
  /**
   * This function will send any error to a log file
   * And die with the error message
   * @param $error
   * @param $custom
   * @return void
   */
  function error($error, $custom = null): void
  {
    if (!is_null($custom)) {
      error_log($custom . "\n", 3, dirname(__DIR__, 2) . '/storage/logs/app.log');
    }
    error_log($error . "\n", 3, dirname(__DIR__, 2) . '/storage/logs/app.log');
    dd($error);
  }
}

if (!function_exists("message_log")) {
  /**
   * This function will send any error to a log file
   * And die with the error message
   * @param $error
   * @param $custom
   * @return void
   */
  function message_log($message): void
  {
    error_log($message . "\n", 3, dirname(__DIR__, 2) . '/storage/logs/app.log');
  }
}
