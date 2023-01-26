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
    // Instantiate model get from namespace App\Models
    $currentModel = "\\App\\Models\\$model";
    return new $currentModel();
  }
  public function view($view, $data = [])
  {
    if (!file_exists('../app/views/' . $view . '.html')) die('View bestaat niet');
    $twig = Core::getTwig();
    $twig->addGlobal("URLROOT", URLROOT);
    $template = $twig->render($view . '.html', $data);
    echo $template;
  }
}
