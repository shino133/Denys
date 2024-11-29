<?php
class CategoryModel extends BaseModel
{
  public static $table = 'categories_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'name' => 'name',
    'description' => 'description',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
