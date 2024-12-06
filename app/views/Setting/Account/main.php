<?php

// dumpVar($extractDataDetails);
$userData ??= [
  'id' => 0,
  'userName' => '',
  'fullName' => '',
  'email' => '',
  'avatarUrl' => '',
  'role' => '',
];

?>
<div class="row message-right-side-content">
  <div class="col-md-12">
    <div id="message-frame">
      <div class="message-sidepanel">
        <?php AppLoader::component("Setting/LeftSide"); ?>
      </div>

      <div class="content">
        <div class="settings-form p-4">
          <h2>Tài khoản</h2>
          <form action="/user/settings/account/request" method="POST" class="mt-4 settings-form">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fullName">Họ và Tên</label>
                <input type="text" class="form-control" value="<?= $userData['fullName'] ?>" name="fullName" id="fullName" placeholder="Nhập tên đầy đủ của bạn" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="<?= $userData['email'] ?>" name="email" id="email" placeholder="Nhập email của bạn" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-row mb-3 align-items-center">
                <div class="col">
                  <label for="userName">Username</label>
                  <input type="text" class="form-control" value="<?= $userData['userName'] ?>" name="userName" id="userName" aria-describedby="usernameHelp" placeholder="Username" />
                  <small id="usernameHelp" class="form-text text-muted">
                    Tên người dùng công khai của bạn. ví dụ: @tennguoidung123
                  </small>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-row mb-3 align-items-center">
                <div class="col">
                  <label for="password">Mật khẩu</label>
                  <input type="password" class="form-control" name="password" id="password"
                    aria-describedby="passwordHelp" placeholder="Password" />
                  <small id="passwordHelp" class="form-text text-muted">
                    Nhập mật khẩu để xác nhận bạn là chủ tài khoản.
                  </small>
                </div>
              </div>
            </div>

            <div class="col-md-6 text-right">
              <button type="submit" class="btn btn-primary btn-sm p-2 sweetalert-success">
                Lưu thay đổi
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>