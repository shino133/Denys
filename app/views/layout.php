<?php
// dumpVar($data);
?>

<div class="container-fluid" id="wrapper">
  <div class="row newsfeed-size">
    <div class="col-md-12 newsfeed-right-side">
      <!-- Header  -->
      <?php AppLoader::component("Layout/Navbar/main", ['userData' => Auth::getUser() ?? []]); ?>
      <?php AppLoader::view(path: $pathView, data: [ "data" => $data]) ?>
    </div>
  </div>
</div>

<script>
  const posts = document.querySelectorAll(".new-post");
  document.getElementById("toggleButton").addEventListener("click", function () {
    posts.forEach((post) => {
      post.classList.toggle("d-none");
    });
  });
</script>