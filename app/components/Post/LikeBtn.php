<?php

?>

<button type="button" class="btn post-card-buttons like-btn <?= $isLikedByCurrentUser ? 'active' : '' ?>" id="like-post-<?= $post_id ?>">
  <i class="bx bxs-like mr-2"></i>
  <span class="like-count"><?= $likeCount ?></span>
</button>