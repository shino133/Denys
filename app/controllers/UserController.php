<?php
AppLoader::model('UserModel');

class UserController extends BaseController
{
  private $model;

  public function __construct() {
    $this->model = new UserModel();
  }

  public function index($username) {
    echo "Welcome $username";
  }
} 
