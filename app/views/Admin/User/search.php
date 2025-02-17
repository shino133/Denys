<div class="row">
  <!-- Header  -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Quản lý người dùng</h3>
    <p class="mb-4">
      Tìm kiếm người dùng
    </p>
  </div>

  <div class="row">
    <div class="col-12">
      <?php

      use App\Features\AdminLoader;

      AdminLoader::component('SearchUserForm', [
        'backUrl' => '/admin/manager/user',
        'baseUrl' => '/admin/manager/user',
        'userData' => $userData ?? [],
        'totalPage' => $totalPage ?? null,
        'currentPage' => $currentPage ?? null,
        'lastPage' => $lastPage ?? null,
        'nextPage' => $nextPage ?? null,
        'previousPage' => $previousPage ?? null,
      ]) ?>
    </div>
  </div>
</div>