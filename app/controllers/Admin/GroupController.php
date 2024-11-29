<?php
AdminLoader::model('GroupModel');

class GroupController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::groupPage();

    $groupData = GroupModel::getGroups(conditions: []);

    $this->setData('groupData', $groupData);

    $this->renderAdmin('Group/main');
  }
}