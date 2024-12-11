<?php



?>
<div class="row newsfeed-right-side-content mt-3">
  <div class="col-md-3 pr-2 sticky-top" id="sidebar-wrapper">
    <?php AppLoader::component("Layout/Sidebar/main"); ?>
  </div>
  <div class="col-md-9 second-section" id="page-content-wrapper">

    <?php AppLoader::component("SearchBox/main") ?>

    <div class="groups bg-white py-3 px-4 shadow-sm">
      <div class="card-head d-flex justify-content-between">
        <h5 class="mb-4">TÌm kiếm bạn bè</h5>
      </div>
      <div id="user-card-container">
        <!-- Search Result -->
      </div>
    </div>
  </div>
</div>