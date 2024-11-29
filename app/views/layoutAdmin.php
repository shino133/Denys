<!-- Sidebar -->
<?php AdminLoader::component("Layout/Sidebar/main"); ?>

<!-- Content -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <!-- Navbar -->
  <?php AdminLoader::component("Layout/Navbar/main"); ?>

  <div class="container-fluid py-3">
    <!-- Main Content  -->
    <?php AppLoader::view(path: $pathView, data: $data) ?>
  </div>
</main>

<!-- Custom Color Button -->
<?php AdminLoader::component("CustomColorBtn"); ?>
