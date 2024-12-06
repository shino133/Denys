<?php
AdminLoader::model('GroupModel');

class GroupAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantsAdmin::groupPage();

    $groupData = GroupModel::getGroups(conditions: []);

    self::setData('groupData', $groupData);

    self::renderAdmin('Group/main');
  }
}