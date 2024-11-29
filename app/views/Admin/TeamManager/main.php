<div class="row">
  <!-- Header  -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Quản lý quyền quản trị</h3>
    <p class="mb-4">
      Thông tin mới nhất hôm nay
    </p>
  </div>

  <div class="row">
    <div class="col-12">
      <?php AdminLoader::component('Table/TeamManagerTable', [
        'teamManagerData' => $teamManagerData ?? []
      ]) ?>
    </div>
  </div>
</div>