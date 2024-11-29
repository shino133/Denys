<?php
AdminLoader::model('UserModel');
class UserController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::userPage();

    $userData = UserModel::read(columns: ['*']);
    $this->setData('userData', $userData);

    // Set data for View
    $this->setAllData(data: [
      'userData' => $userData
    ]);
    
    $this->renderAdmin('User/main');
  }
}