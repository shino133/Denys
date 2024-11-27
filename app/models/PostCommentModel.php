<?php
class PostCommentModel extends BaseModel
{
  public $table = 'post_comments_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'post_id' => 'postId',
    'comments_id' => 'commentsId',
    'created_at' => 'createdAt'
  ];

  public function addPostComment($data)
  {
    return $this->create([
      'postId' => $data['post_id'],
      'commentsId' => $data['comments_id']
    ]);
  }
}
