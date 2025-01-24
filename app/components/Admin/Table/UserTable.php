<?php

use App\Features\AppLoader;
use App\Features\Auth;

$baseUrl ??= "/admin/manager/user";

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


<div class="table-responsive p-0">
  <table class="table align-items-center mb-0">
    <thead>
      <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và Tên</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người dùng</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vai trò</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
        <th class="text-secondary opacity-7">
          <div class="d-flex justify-content-center align-items-center ">
            <button type="button" onClick="window.location.reload();"
              class="btn m-0 text-warning font-weight-bold text-xs d-flex justify-content-center align-items-center">
              <i class="material-symbols-rounded opacity-5">refresh</i>
              <span>Refresh</span>
            </button>
            <a href="<?= $baseUrl ?>/add"
              class="text-info font-weight-bold text-xs d-flex justify-content-center align-items-center">
              <i class="material-symbols-rounded opacity-5">add</i>
              <span>Thêm</span>
            </a>
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($userData as $data) : ?>
        <tr>
          <!-- Họ và Tên -->
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="/assets/img/<?= $data['avatarUrl'] ?>" class="avatar avatar-sm me-3 border-radius-lg"
                  alt="user1">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm"><?= htmlspecialchars($data['fullName']) ?></h6>
                <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($data['email']) ?></p>
              </div>
            </div>
          </td>
          <!-- Người dùng -->
          <td>
            <a href="/@<?= htmlspecialchars($data['userName']) ?>" class="text-sm text-secondary mb-0" target="_blank">
              @<?= htmlspecialchars($data['userName']) ?>
            </a>
          </td>
          <!-- Vai trò -->
          <td class="align-middle text-center text-sm">
            <span class="<?= $roleBadgeColor($data['role']) ?>">
              <?= htmlspecialchars(ucfirst($data['role'])) ?>
            </span>
          </td>
          <!-- Trạng thái -->
          <td class="align-middle text-center text-sm">
            <span class="badge badge-sm <?= $activeTextColor($data['status']) ?>">
              <?= htmlspecialchars($data['status']) ?>
            </span>
          </td>
          <!-- Hành động -->
          <?php if (isset($data['id']) && $data['id'] !== Auth::getUser('id') && $data['role'] !== 'editor') : ?>
            <td class="align-middle">
              <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="<?= $baseUrl ?>/<?= $data['id'] ?>/edit"
                  class="text-success font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">edit</i>
                  <span>Sửa</span>
                </a>
                <a href="<?= $baseUrl ?>/<?= $data['id'] ?>/destroy/request"
                  class="text-danger font-weight-bold text-xs d-flex justify-content-center align-items-center sweetalert-success">
                  <i class="material-symbols-rounded opacity-5">delete</i>
                  <span>Xoá</span>
                </a>
              </div>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if (empty($userData) == false) : ?>
    <?php AppLoader::component('NavPagination', [
      'baseUrl' => $baseUrl,
      'totalPage' => $totalPage,
      'currentPage' => $currentPage,
      'lastPage' => $lastPage,
      'nextPage' => $nextPage,
      'previousPage' => $previousPage,
    ]) ?>
  <?php endif; ?>
</div>