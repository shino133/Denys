<?php
class UserWishlistModel extends BaseModel
{
  public static $table = 'user_wishlist'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
