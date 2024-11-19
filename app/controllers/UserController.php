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
} 
