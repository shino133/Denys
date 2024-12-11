<?php

$postData ??= [];
// dumpVar($postData);
$mediaData = [];
foreach ($postData as $media) {
  if (empty($media['post_mediaUrl'])) {
    continue;
  }

  $mediaData[] = [
    'post_id' => $media['post_id'],
    'post_mediaUrl' => $media['post_mediaUrl'],
  ];
}

?>
<h6 class="text-muted timeline-title">Ảnh gần đây</h6>

<?php if (empty($mediaData) == false) : ?>
  <?php foreach ($mediaData as $media) : ?>
    <div class="quick-media">
      <a href="/post/<?= $media['post_id'] ?>" class="quick-media-img" target="_blank">
        <img src="/assets/img/users/<?= $media['post_mediaUrl'] ?>" alt="Quick media" class="border-content" />
      </a>
    </div>
  <?php endforeach; ?>

<?php else : ?>
  <div class="alert" role="alert">
    <i class='bx bx-images'></i>
    Không có Ảnh
  </div>
<?php endif; ?>