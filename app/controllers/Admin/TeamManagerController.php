<?php
AdminLoader::model('UserModel');
class TeamManagerController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::teamManagerPage();

    $teamManagerData = $this->getData();

    // Set data for View
    $this->setAllData(data: [
      'teamManagerData' => $teamManagerData
    ]);

    $this->renderAdmin('TeamManager/main');
  }

  public function addPage()
  {
    ConstantsAdmin::teamManagerPage();
    
    $this->renderAdmin('TeamManager/add');
  }

  public function getData() {
    AdminLoader::util('TimeHelper');

    $teamManagerData = UserModel::getTeamManager();

    foreach ($teamManagerData as $key => $data) {
      $formatDate = TimeHelper::formatDate($data['createdAt']);
      $teamManagerData[$key]['createdAt'] = $formatDate;
    }

    return $teamManagerData;
  }
}