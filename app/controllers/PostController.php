<?php
class PostController extends BaseController
{
  public function index()
  {
    $this->render('Post/main');
  }
}