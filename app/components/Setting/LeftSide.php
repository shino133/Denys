<?php

$links = [
  'account' => '/user/settings/account',
  'contact' => '/user/settings/contact',
  'password' => '/user/settings/password',
]

?>
<div class="message-contacts settings-sidebar">
  <ul class="conversations">
    <h6 class="p-3">Cài đặt chung</h6>

    <li class="contact setting-active">
      <a href="<?= $links['account'] ?>" class="wrap d-flex align-items-center">
        <img src="/public/img/icons/settings/account.png" class="settings-icon" alt="Settings left sidebar" />
        <div class="meta">
          <p>Tài khoản</p>
        </div>
      </a>
    </li>

    <li class="contact">
      <a href="<?= $links['contact'] ?>" class="wrap d-flex align-items-center">
        <img src="/public/img/icons/settings/contact.png" class="settings-icon" alt="Settings left sidebar" />
        <div class="meta">
          <p>Thông tin liên hệ</p>
        </div>
      </a>
    </li>

    <h6 class="p-3">Bảo mật và An toàn</h6>
    <li class="contact">
      <a href="<?= $links['password'] ?>" class="wrap d-flex align-items-center">
        <img src="/public/img/icons/settings/account.png" class="settings-icon" alt="Settings left sidebar" />
        <div class="meta">
          <p>Password</p>
        </div>
      </a>
    </li>
  </ul>
</div>