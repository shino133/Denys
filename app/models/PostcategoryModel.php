<?php
class PostCategoryModel extends BaseModel
{
  protected $table = 'post_categories_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_id' => 'postId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
