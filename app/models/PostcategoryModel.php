<?php
class PostcategoryModel extends BaseModel
{
  protected $table = 'post_categories_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'postld' => 'postld',
    'categoryld' => 'categoryld',
    'createdAt' => 'createdAt'
  ];
}
