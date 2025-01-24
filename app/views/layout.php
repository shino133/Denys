<?php
// dumpVar(Auth::getUser());

use App\Features\AppLoader;
use App\Features\Auth;

?>

<div class="container-fluid" id="wrapper">
  <div class="row newsfeed-size">
    <div class="col-md-12 newsfeed-right-side">
      <!-- Header  -->
      <?php AppLoader::component("Layout/Navbar/main", ['userData' => Auth::getUser() ?? []]); ?>
      <?php AppLoader::view(path: $pathView, data: $data) ?>
    </div>
  </div>
</div>

