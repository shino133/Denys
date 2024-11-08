<?php
app_model('UserModel');

class UserController extends BaseController
{
  private $model;

  public function __construct() {
    $this->model = new UserModel();
  }

  public function index() {
    $users = $this->model->getAll();
    $this->setData('users', $users);
    $this->render('User/main');
  }
}
