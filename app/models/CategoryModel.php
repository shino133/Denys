<?php
class CategoryModel extends BaseModel
{
  public $table = 'categories_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'name' => 'name',
    'description' => 'description',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
