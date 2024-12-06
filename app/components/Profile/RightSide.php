<?php

$postData ??= [];
// dumpVar($postData);

?>
<h6 class="text-muted timeline-title">Ảnh gần đây</h6>
<?php foreach ($postData as $media) : ?>
  <?php if (empty($media['post_mediaUrl'])) continue; ?>
  <div class="quick-media">
    <a href="/post/<?= $media['post_id'] ?>" class="quick-media-img" target="_blank">
      <img src="/assets/img/users/<?= $media['post_mediaUrl'] ?>" alt="Quick media" class="border-content" />
    </a>
  </div>
<?php endforeach; ?>