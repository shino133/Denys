<?php
class CommentModel extends BaseModel
{
  protected $table = 'comments_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'content' => 'content',
    'media_Type' => 'mediaType',
    'media_Url' => 'mediaUrl',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt'
  ];
}
