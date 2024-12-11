<?php
$defaults = [
  "comment_id" => 0,
  "comment_content" => "",
  "comment_mediaType" => "",
  "comment_mediaUrl" => "",
  "user_userId" => 0,
  "user_userName" => "Anonymous",
  "user_fullName" => "Anonymous",
  "user_avatarUrl" => "",
  "postComment_id" => 0,
  "postComment_postId" => 0,
  "postComment_createdAt" => "0",
  "timeAgo" => ""
];

foreach ($defaults as $key => $defaultValue) {
  $$key = $comment[$key] ?? $defaultValue;
}
?>

<a href="/@<?= $user_userName ?>" class="pull-left">
  <?php if ($user_avatarUrl) : ?>
    <img src="<?= "/assets/img/users/$user_avatarUrl" ?>" alt="Online user" class="img-circle avt"
      style="height: 30px; width: 30px;" />
  <?php else : ?>
    <div class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image"
      style="height: 30px; width: 30px;"><span class=""><?= strtoupper($user_fullName)[0] ?></span></div>
  <?php endif; ?>
</a>
<div class="media-body">
  <div class="d-flex justify-content-between align-items-center w-100">
    <strong class="text-gray-dark"><a href="/@<?= $user_userName ?>" class="fs-8"><?= $user_fullName ?></a></strong>
    <a href="#"><i class="bx bx-dots-horizontal-rounded"></i></a>
  </div>
  <span class="d-block comment-created-time"><?= $timeAgo ?></span>
  <?php if ($comment_content) : ?>
    <p class="fs-8 pt-2">
      <?= $comment_content ?>
    </p>
  <?php endif; ?>
  <?php if ($comment_mediaUrl) : ?>
    <div class="bg-transparent h-50 w-50 d-flex justify-content-center">
      <img src="<?= "/assets/img/comments/$comment_mediaUrl" ?>" alt="Image Preview" class="border-card m-3 w-100">
    </div>
  <?php endif; ?>
</div>