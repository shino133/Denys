<?php

// dumpVar($extractDataDetails);
$baseUrl = "/user/settings/password";

?>
<div class="row message-right-side-content">
  <div class="col-md-12">
    <div id="message-frame">
      <div class="message-sidepanel">
        <?php AppLoader::component("Setting/LeftSide"); ?>
      </div>

      <div class="content">
        <div class="settings-form p-4">
          <h2>Đổi mật khẩu</h2>
          <form action="<?= $baseUrl ?>/request" method="POST" class="mt-4 settings-form">

            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Mật khẩu cũ</label>
                <input type="password" class="form-control" name="password"
                  id="password" placeholder="Nhập tên đầy đủ của bạn" />
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="newPassword">Mật khẩu mới</label>
                <input type="password" class="form-control" name="newPassword"
                  id="newPassword" placeholder="Nhập tên đầy đủ của bạn" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="confirmNewPassword">Xâc nhận mật khẩu mới</label>
                <input type="password" class="form-control" name="confirmNewPassword"
                  id="confirmNewPassword" placeholder="Nhập tên đầy đủ của bạn" />
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