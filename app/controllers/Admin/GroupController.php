<?php
AdminLoader::model('GroupModel');

class GroupController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::groupPage();

    $groupData = GroupModel::read(columns: ['*']);

    $this->setData('groupData', $groupData);

    $this->renderAdmin('Group/main');
  }
}