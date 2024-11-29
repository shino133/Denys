<?php

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
    'user' => 'badge bg-gradient-primary',
    default => 'badge bg-gradient-secondary',
  };
};

?>
<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
      <h6 class="text-white text-capitalize ps-3">Danh sách User</h6>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
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
                <a href="/admin/team-manager/add"
                  class="text-info font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">add</i>
                  <span>Thêm</span>
                </a>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($userData as $data): ?>
            <tr>
              <!-- Họ và Tên -->
              <td>
                <div class="d-flex px-2 py-1">
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
              <td class="align-middle">
                <div class="d-flex justify-content-center align-items-center gap-3">
                  <a href="/admin/manager/group/edit"
                    class="text-success font-weight-bold text-xs d-flex justify-content-center align-items-center">
                    <i class="material-symbols-rounded opacity-5">edit</i>
                    <span>Sửa</span>
                  </a>
                  <a href="/admin/manager/group/delete"
                    class="text-danger font-weight-bold text-xs d-flex justify-content-center align-items-center">
                    <i class="material-symbols-rounded opacity-5">delete</i>
                    <span>Xoá</span>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>