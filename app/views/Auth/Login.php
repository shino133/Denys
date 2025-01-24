<?php

use App\Features\AppLoader;

?>
<div class="row ht-100v flex-row-reverse no-gutters">
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <div class="container mx-5">
      <div class="auth-logo text-center mb-5">
        <div class="row">
          <div class="col-md-2">
            <img src="/logo/logo-64x64.png" class="logo-img" alt="Logo" />
          </div>
          <div class="col-md-8">
            <p>Denys</p>
            <span>Đăng nhập</span>
          </div>
        </div>
      </div>
      <form action="/user/request/login" method="POST">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" />
              <div class="form-text text-danger" id="error-username"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="password" placeholder="Password" />
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-light toggle-password">
                    Hiện
                  </button>
                </div>
              </div>
              <div class="text-sm text-danger" id="error-password"></div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <a href="/user/forgot-password">Quên mật khẩu?</a>
          </div>
          <div class="col-md-12 text-right">
            <div class="form-group">
              <button type="submit" class="btn btn-orange rounded-pill sign-up">
                Đăng nhập
              </button>
            </div>
          </div>
          <div class="col-md-12 text-center mt-5">
            <span class="go-login">Chưa có tài khoản? <a href="/user/register">Đăng ký ngay</a></span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-6 auth-bg-image d-flex justify-content-center align-items-center">
    <div class="auth-left-content mt-5 mb-5 text-center">
      <?php AppLoader::component("ApiWeather") ?>
      <div class="text-white mt-5 mb-5">
        <h2 class="create-account mb-3">Denys</h2>
        <p>
          Chào mừng đã quay trở lại với chúng tôi.
        </p>
      </div>
    </div>
  </div>
</div>