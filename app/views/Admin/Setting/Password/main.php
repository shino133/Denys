<?php

// dumpVar($extractDataDetails);
$baseUrl = "/user/settings/password";

?>
<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
      <h6 class="text-white text-capitalize ps-3">Thay đổi mật khẩu</h6>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
      <div class="settings-form p-4">
          <form action="<?= $baseUrl ?>/request" method="POST" class="mt-4 settings-form">
      
          <div class="form-text text-danger text-end">
            <div class="input-group input-group-outline mb-3">
              <label class="form-label" for="password">Mật khẩu cũ</label>
              <input type="password" class="form-control" name="password" id="password"
              />
            </div>
          </div>
      
          <div class="form-text text-danger text-end">
            <div class="input-group input-group-outline mb-3">
              <label class="form-label" for="newPassword">Mật khẩu mới</label>
              <input type="password" class="form-control" name="newPassword" id="newPassword"
              />
            </div>
          </div>
      
          <div class="form-text text-danger text-end">
            <div class="input-group input-group-outline mb-3">
              <label class="form-label" for="confirmNewPassword">Xâc nhận mật khẩu mới</label>
              <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword"
              />
            </div>
          </div>
      
          <div class="text-center">
                  <button type="submit"
                    class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0 sweetalert-success">Xác nhận</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>

