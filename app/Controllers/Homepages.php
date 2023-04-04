<?php

namespace App\Controllers;

use App\Libraries\BaseController;

/**
 * Class Homepages
 * This class represents a controller for the homepage. The index method sets the data to be passed to the view and
 * renders the view template.
 * Usage:
 * $homepages = new Homepages();
 * $homepages->index();
 * @package App\Controllers
 */
class Homepages extends BaseController
{
  /**
   * Renders the homepage view.
   * @return void
   */
  public function index(): void
  {
    // Set the data to be passed to the view.
    $this->setData([
      'title' => 'Home',
      'name' => 'John Doe',
    ]);

    // Render the view.
    $this->view('homepages/index');
  }
}
