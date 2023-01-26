<?php

namespace App\Libraries;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

/**
 * 
 */
class Core
{

  protected static $twig;
  protected $currentController = 'Homepages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    $this->setTwigInstance();
    // var_dump($this->getURL());
    $url = $this->getURL();

    // var_dump($url);exit();
    // var_dump($url);echo '../app/controllers/' . ucwords($url[0]) . '.php';exit();
    // We hebben ../nodig omdat we Core.php require vanuit index.php
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // Zet de currentController gelijk aan het eerste woord na het domein
      $this->currentController = ucwords($url[0]);
      // echo $this->currentController;exit();
      unset($url[0]);
    }

    // Maak een nieuwe instantie van de controllerClass
    $this->currentController = "\\App\\Controllers\\$this->currentController";
    $this->currentController = new $this->currentController();

    // Kijk naar het tweede gedeelte van de url en zet de method
    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    $this->params = $url ? array_values($url) : [];

    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getURL()
  {
    // de $_SERVER['REQUEST_URI'] komt van /public/.htaccess regel 7
    if (isset($_SERVER['REQUEST_URI'])) {
      // Haal de backslash vooraan de url af
      $url = rtrim($_SERVER['REQUEST_URI'], '/');

      $url = filter_var($url, FILTER_SANITIZE_URL);

      $url = explode('/', $url);

      array_shift($url);

      return $url;
    } else {
      return array('homepages', 'index');
    }
  }

  public function setTwigInstance()
  {
    $loader = new FilesystemLoader('../app/views');
    self::$twig = new Environment($loader, [
      'cache' => false,
      'debug' => true
    ]);
    // self::$twig->addExtension(new \Twig\Extension\DebugExtension());
  }

  public static function getTwig()
  {
    return self::$twig;
  }
}
