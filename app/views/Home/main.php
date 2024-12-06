<?php
$posts ??= [];
// dumpVar($posts);
?>

<!-- Content -->
<div class="row newsfeed-right-side-content mt-3">
  <!-- Sidebar Left  -->
  <div class="col-md-3 newsfeed-left-side sticky-top shadow-sm" id="sidebar-wrapper">
    <?php AppLoader::component("Layout/Sidebar/main"); ?>
  </div>

  <!-- Main Content  -->
  <div class="col-md-6 second-section" id="page-content-wrapper">
    <div class="mb-3">
      <?php AppLoader::component("ToolBaseBtn"); ?>
    </div>
    <div class="pb-3">
      <?php AppLoader::component("NewPost"); ?>
    </div>

    <!-- Posts -->
    <div class="posts-section mb-5">
      <?php foreach ($posts as $post) : ?>
        <div class="pt-3">
          <div class="post border-card border-bottom p-3 bg-white w-shadow" id="post-card-<?= $post_id ?>">
            <?php AppLoader::component("Post/Card", $post); ?>
          </div>
        </div>
      <?php endforeach; ?>
      <?php AppLoader::component("LoadPostBtn") ?>
    </div>
  </div>

  <!-- Sidebar Right -->
  <div class="col-md-3 third-section">
    <?php AppLoader::component("Layout/Sidebar/Right"); ?>
  </div>
</div>