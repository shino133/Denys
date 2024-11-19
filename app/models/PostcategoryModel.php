<?php
class PostcategoryModel extends BaseModel
{
  protected $table = 'post_categories_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_Id' => 'postId',
    'category_Id' => 'categoryId',
    'created_At' => 'createdAt'
  ];
}
