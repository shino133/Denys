<?php

$backUrl ??= '/admin/user';
$baseUrl ??= '/admin/user';

?>
<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3">
      <a href="<?= $backUrl ?>" class="text-white d-flex align-items-center ps-3 gap-1">
        <i class="material-symbols-rounded opacity-5">keyboard_backspace</i>
        <span class="text-capitalize ">Back</span>
      </a>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="card card-plain">
      <div class="card-header">
        <h4 class="font-weight-bolder text-center">Tìm kiếm người dùng</h4>
      </div>
      <div class="card-body">
        <form action="<?= "$baseUrl/search"?>" method="get">
          <div class="input-group input-group-outline mb-0">
            <label class="form-label">Tên người dùng</label>
            <input type="text" name="username" class="form-control">
          </div>
          <p class="text-center mb-0">hoặc</p>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Tìm kiếm</button>
          </div>
        </form>
      </div>

      <?php if (isset($userData) && count($userData) > 0): ?>
        <div class="card-footer">
          <?php AdminLoader::component('Table/UserTable', [
            'userData' => $userData ?? [],
            'totalPage' => $totalPage ?? null,
            'currentPage' => $currentPage ?? null,
            'lastPage' => $lastPage ?? null,
            'nextPage' => $nextPage ?? null,
            'previousPage' => $previousPage ?? null,
          ]) ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>