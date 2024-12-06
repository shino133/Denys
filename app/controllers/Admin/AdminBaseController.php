<?php
class AdminBaseController extends BaseController {
  public static function renderAdmin($viewAdmin, $useBaseLayout = true, $pathLayoutAdmin = 'layoutAdmin') {
    self::render( "Admin/$viewAdmin", $useBaseLayout, $pathLayoutAdmin);
  }

  public static function redirectAdmin($url) {
    self::redirect(BASE_URL_ADMIN . $url);
  }
}