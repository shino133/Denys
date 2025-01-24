<div class="row ht-100v flex-row-reverse no-gutters">
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <div class="container mx-5">
      <div class="auth-logo text-center mb-5">
        <div class="row">
          <div class="col-md-2">
            <img src="/public/logo/logo-64x64.png" class="logo-img" alt="Logo" />
          </div>
          <div class="col-md-10">
            <p>Denys</p>
            <span>Đăng ký tài khoản</span>
          </div>
        </div>
      </div>
      <form action="/user/request/register" method="POST" class="pt-1">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="fullName" placeholder="Full Name" />
              <div class="form-text text-danger" id="error-fullName"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email Address" />
              <div class="form-text text-danger" id="error-email"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" />
              <div class="form-text text-danger" id="error-username"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="password" placeholder="Password" />
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-light toggle-password">
                    Hiện
                  </button>
                </div>
              </div>
              <div class="form-text text-danger" id="error-password"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" />
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-light toggle-password">
                    Hiện
                  </button>
                </div>
              </div>
              <div class="form-text text-danger" id="error-confirmPassword"></div>
            </div>
          </div>
          <div class="col-md-12">
            <p class="agree-privacy">
              Bằng cách nhấp vào nút Đăng ký bên dưới, bạn đã đồng ý với chính sách bảo mật và các điều khoản sử dụng
              trang web của chúng tôi.
            </p>
          </div>
          <div class="col-md-7">
            <span class="go-login">Đã có tài khoản? <a href="/user/login">Đăng nhập ngay</a></span>
          </div>
          <div class="col-md-5 text-right">
            <div class="form-group">
              <button type="submit" class="btn btn-orange rounded-pill sign-up">
                Đăng ký
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-6 auth-bg-image d-flex justify-content-center align-items-center">
    <div class="auth-left-content mt-5 mb-5 text-center">
      <?php App\Features\AppLoader::component("ApiWeather") ?>
      <div class="text-white mt-5 mb-5">
        <h2 class="create-account mb-3">Tạo tài khoản</h2>
        <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình cùng chúng tôi.</p>
      </div>
    </div>
  </div>
</div>