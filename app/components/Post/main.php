<?php
// dumpVar($comments);
$data = [
  'post_id' => $post_id ?? '',
  'post_content' => $post_content ?? '',
  'post_mediaType' => $post_mediaType ?? '',
  'post_mediaUrl' => $post_mediaUrl ?? '',
  'post_createdAt' => $post_createdAt ?? '',
  'user_userId' => $user_userId ?? 0,
  'user_avatarUrl' => $user_avatarUrl ?? '',
  'user_userName' => $user_userName ?? 'Anonymous',
  'user_fullName' => $user_fullName ?? 'Anonymous',
  'likeCount' => $likeCount ?? 0,
  'commentCount' => $commentCount ?? 0,
  'timeAgo' => $timeAgo ?? '',
  'isLikedByCurrentUser' => $isLikedByCurrentUser ?? false,
  'comments' => $comments ?? [],
];
?>
<div class="post border-card border-bottom p-3 bg-white w-shadow" id="post-card-<?= $post_id ?>">
  <?php AppLoader::component("Post/Card", $data) ?>

  <div class="input-group-btn">
    <div class="border-top pt-3 hide-comments">
      <?php AppLoader::component("Comment/main", ["comments" => $comments, "postId" => $post_id]) ?>
    </div>
  </div>
</div>