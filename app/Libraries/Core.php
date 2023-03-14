<?php

namespace App\Libraries;

use App\Exceptions\Container\ContainerException;
use App\Support\Container;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Core
{

  protected static $twig;
  protected $currentController = 'Homepages';
  protected $currentMethod = 'index';
  protected $params = [];

  public static Container $container;

  public function __construct()
  {
    $this->setTwigInstance();
    // var_dump($this->getURL());
    $url = $this->getURL();

    // var_dump($url);exit();
    // var_dump($url);echo '../app/controllers/' . ucwords($url[0]) . '.php';exit();
    // We hebben ../nodig omdat we Core.php require vanuit index.php
    if (isset($url[0]) && file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')) {
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


  public static function boot()
  {
    static::$container = new Container();
  }


  /**
   * Register a new binding in the container
   * @param string $id
   * @param string|callable $concrete
   * @return mixed
   */
  public static function make(string $id, string|callable $concrete): mixed
  {
    return static::$container->bind($id, $concrete);
  }

  /**
   * Register a new binding in the container as a singleton
   * @param string $id
   * @param string|callable|object $concrete
   * @return mixed
   */
  public function singleton(string $id, string|callable|object $concrete): mixed
  {
    return static::$container->bind($id, $concrete, true);
  }

  /**
   * Get the value of a binding from the container
   * @param string $id
   * @return mixed
   */
  public function get(string $id): mixed
  {
    try {
      return static::$container->get($id);
    } catch (ContainerException | \Exception $exception) {
      error($exception, "ERROR: Something went wrong when resolving the dependency's");
    }
  }
}
