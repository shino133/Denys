<?php
namespace App\Controllers;

use App\Features\AppLoader;
use Core\Deny\Controllers\BaseController;

class Controller extends BaseController
{
  protected static function render($view, $useBaseLayout = true, $pathLayout = 'layout')
  {
    // dumpVar(self::$data);
    AppLoader::view('main', [
      'data' => self::$data,
      'pathView' => $view,
      'useBaseLayout' => $useBaseLayout,
      'pathLayout' => $pathLayout
    ]);
  }
}