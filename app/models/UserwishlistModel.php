<?php
class UserWishlistModel extends BaseModel
{
  protected $table = 'user_wishlist'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_id' => 'userId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
