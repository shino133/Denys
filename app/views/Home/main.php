<?php
$posts ??= [];
$user ??= [];
// dumpVar($posts);
?>

<div class="container-fluid" id="wrapper">
  <div class="row newsfeed-size">
    <div class="col-md-12 newsfeed-right-side">
      <!-- Header  -->
      <?php AppLoader::component("Layout/Navbar/main"); ?>

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
              <?php AppLoader::component("Post/Card", $post); ?>
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
    </div>
  </div>
</div>


<!-- Modals -->
<?php AppLoader::component("Comments/main") ?>

<!-- Chat Popup -->
<?php AppLoader::component("ChatPopup/main") ?>
<!-- END Chat Popup -->

<!-- Call modal -->
<?php AppLoader::component("CallModal/main") ?>
<!-- END call modal -->
</div>

<script>
  const posts = document.querySelectorAll(".new-post");
  document.getElementById("toggleButton").addEventListener("click", function () {
    posts.forEach((post) => {
      post.classList.toggle("d-none");
    });
  });
</script>