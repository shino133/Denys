<?php
class HomeController extends AdminBaseController
{
  public function index()
  {
    $this->redirectAdmin('dashboard');
  }

  public function dashboard()
  {
    ConstantsAdmin::homePage();

    AdminLoader::controller('TeamManagerController');
    $teamManagerData = (new TeamManagerController)->getData();

    $this->setAllData(data: [
      'teamManagerData' => $teamManagerData
    ]);

    $this->renderAdmin('Home/main');
  }

}
