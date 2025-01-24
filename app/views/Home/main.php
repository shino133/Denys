<?php

use App\Features\AppLoader;

$posts ??= [];

?>

<!-- Content -->
<div class="row newsfeed-right-side-content mt-3">
  <!-- Sidebar Left  -->
  <div class="col-md-3 sticky-top" id="sidebar-wrapper">
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
      <div id="post-container">
        <div id="post-wrapper-0">
          <?php AppLoader::component("Post/NewPosts", ['posts' => $posts]) ?>
        </div>
      </div>
      <?php AppLoader::component("LoadPostBtn") ?>
    </div>
  </div>

  <!-- Sidebar Right -->
  <div class="col-md-3 third-section">
    <?php AppLoader::component("Layout/Sidebar/Right"); ?>
  </div>
</div>