<?php
class UserWishlistModel extends BaseModel
{
  public $table = 'user_wishlist'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
