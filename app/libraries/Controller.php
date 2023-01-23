<?php

namespace App\Libraries;

use App\Libraries\Core;
// Dit wordt de parentclass van alle andere controller
// We loaden de model en de view
class Controller
{
  public function model($model)
  {
    require_once('../app/models/' . $model . '.php');
    return new $model();
  }
  public function view($view, $data = [])
  {
    if (!file_exists('../app/views/' . $view . '.twig')) die('View bestaat niet');
    $twig = Core::getTwig();
    $twig->addGlobal("URLROOT", URLROOT);
    $template = $twig->render($view . '.twig', $data);
    echo $template;
  }
}
