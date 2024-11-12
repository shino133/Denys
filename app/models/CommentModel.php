<?php
class CommentModel extends BaseModel
{
  protected $table = 'comments_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'content' => 'content',
    'mediaType' => 'mediaType',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
