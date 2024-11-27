<?php
AppLoader::controller('Admin/AdminBaseController');
class HomeController extends AdminBaseController
{
  public function index()
  {
    Constants::homeAdmin();
    Title::set('Admin Home - ' . APP_NAME);

    $this->renderAdmin( 'Home/main');
  }

}
