<?php

use App\Features\AdminLoader;

$activeTextColor = function ($status) {
  return match ($status) {
    'active' => 'bg-gradient-success',
    'deleted' => 'bg-gradient-danger',
    'pending' => 'bg-gradient-warning',
    default => 'bg-gradient-secondary',
  };
};

// Thẻ hiển thị màu vai trò
$roleBadgeColor = function ($role) {
  return match ($role) {
    'admin' => 'badge bg-gradient-info',
    'editor' => 'badge bg-gradient-warning',
    'user' => 'badge bg-gradient-primary',
    default => 'badge bg-gradient-secondary',
  };
};


?>


<div class="row">
  <!-- Header  -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Quản lý quyền quản trị</h3>
    <p class="mb-4">
      Quản trị viên
    </p>
  </div>

 <div class=" row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3 ">Danh sách quản trị viên</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <?php AdminLoader::component('Table/UserTable', [
            'userData' => $userData ?? [],
            'totalPage' => $totalPage,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'nextPage' => $nextPage,
            'previousPage' => $previousPage,
          ])?>
        </div>
      </div>
    </div>
  </div>
</div>