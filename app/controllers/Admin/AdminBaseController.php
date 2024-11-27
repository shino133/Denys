<?php
class AdminBaseController extends BaseController {
  public function renderAdmin($viewAdmin, $useBaseLayout = true, $pathLayoutAdmin = 'layoutAdmin') {
    $this->render( "Admin/$viewAdmin", $useBaseLayout, $pathLayoutAdmin);
  }
}