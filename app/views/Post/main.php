<?php
$posts ??= [];
// dumpVar($posts);
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

    <!-- Posts -->
    <div class="posts-section mb-5">
      <?php foreach ($posts as $post) : ?>
        <div class="pt-3">
          <?php AppLoader::component("Post/main", $post); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Sidebar Right -->
  <div class="col-md-3 third-section">
    <?php AppLoader::component("Layout/Sidebar/Right"); ?>
  </div>
</div>



<?php // Components
// AppLoader::component("Comments/main");
// AppLoader::component("ChatPopup/main");
// AppLoader::component("CallModal/main"); 

AppLoader::component("NewPostModal");
?>