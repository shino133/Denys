<?php
AppLoader::model('UserModel');

class UserController extends BaseController
{
  private $model;

  public function __construct() {
    $this->model = new UserModel();
  }

  public function index() {
    $userData = $this->model->read(['*']);

    $this->setData('username', $userData);

    $this->render('User/main');
  }

  public function getProfileData() {
    
  }

  public function validatePublicData($data) {
    return [
      'id' => $data['id'],
      'user_name' => $data['userName'],
      'email' => $data['email'],
      'full_name' => $data['fullName'],
      'avatar_url' => $data['avatarUrl'],
      'role' => $data['role']
    ];
  }
} 
