<?php
class UserwishlistModel extends BaseModel
{
  protected $table = 'user_wishlist'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'category_Id' => 'categoryId',
    'created_At' => 'createdAt'
  ];
}
