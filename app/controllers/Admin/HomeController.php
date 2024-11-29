<?php
class HomeController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::home();

    $this->renderAdmin( 'Home/main');
  }

}
