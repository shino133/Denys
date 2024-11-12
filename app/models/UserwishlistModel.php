<?php
class UserwishlistModel extends BaseModel
{
  protected $table = 'user_wishlist'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'categoryld' => 'categoryld',
    'createdAt' => 'createdAt'
  ];
}
