<?php

use App\Features\AppLoader;

$posts ??= [];

?>

<?php if (empty($posts) == false) : ?>
  <?php foreach ($posts as $post) : ?>
    <div class="pt-3">
      <div class="post border-card border-bottom p-3 bg-white w-shadow" id="post-card-<?= $post['post_id'] ?>">
        <?php AppLoader::component("Post/Card", $post); ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>