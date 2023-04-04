<?php

namespace App\Libraries;

use Twig\Environment;
use App\Libraries\Core;

/**
 * Base Controller class for handling common functionality for controllers
 */
class BaseController
{
  /**
   * The Twig environment instance
   *
   * @var Environment
   */
  protected Environment $twig;

  /**
   * The data that will be passed to the view
   *
   * @var array
   */
  protected array $data = [];

  /**
   * Render a Twig template and output the result
   *
   * @param string $template The name of the Twig template to render
   * @return void
   */
  protected function view(string $template): void
  {
    $this->twig = Core::getTwig();

    echo $this->twig->render($template . '.twig', $this->data);
  }

  /**
   * Send a JSON response to the client
   * 
   * @param array $data The data to be sent as JSON
   * @return void
   */
  protected function json(array $data): void
  {
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  /**
   * Set the data that will be passed to the view
   *
   * @param array $data The data to be set
   * @return void
   */
  protected function setData(array $data): void
  {
    $this->data = $data;
  }

  /**
   * Add data to the existing data array that will be passed to the view
   *
   * @param array $data The data to be added
   * @return void
   */
  protected function addData(array $data): void
  {
    $this->data = array_merge($this->data, $data);
  }

  /**
   * Get the data that will be passed to the view
   *
   * @return array The data to be passed to the view
   */
  public function getData(): array
  {
    return $this->data;
  }
}
