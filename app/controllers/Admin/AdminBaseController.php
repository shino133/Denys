<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;

class AdminBaseController extends Controller {
  public static function renderAdmin($viewAdmin, $useBaseLayout = true, $pathLayoutAdmin = 'layoutAdmin') {
    self::render( "Admin/$viewAdmin", $useBaseLayout, $pathLayoutAdmin);
  }

  public static function redirectAdmin($url) {
    self::redirect(BASE_URL_ADMIN . $url);
  }
}