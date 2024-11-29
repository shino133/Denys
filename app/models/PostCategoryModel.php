<?php
class PostCategoryModel extends BaseModel
{
  public static $table = 'post_categories_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'post_id' => 'postId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
