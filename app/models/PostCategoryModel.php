<?php
class PostCategoryModel extends BaseModel
{
  public $table = 'post_categories_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'post_id' => 'postId',
    'category_id' => 'categoryId',
    'created_at' => 'createdAt'
  ];
}
