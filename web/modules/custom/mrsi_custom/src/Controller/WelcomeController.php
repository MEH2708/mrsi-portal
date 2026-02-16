<?php

namespace Drupal\mrsi_custom\Controller;

use Drupal\Core\Controller\ControllerBase;

class WelcomeController extends ControllerBase {

  public function welcome() {
    return [
      '#markup' => '<h2>Welcome to MRSI Custom Backend Page</h2>',
    ];
  }

}
