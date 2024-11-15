<div class="row ht-100v flex-row-reverse no-gutters">
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <div class="signup-form">
      <div class="auth-logo text-center mb-5">
        <div class="row">
          <div class="col-md-2">
            <img src="assets/images/logo-64x64.png" class="logo-img" alt="Logo" />
          </div>
          <div class="col-md-10">
            <p>Argon Social Network</p>
            <span>Design System</span>
          </div>
        </div>
      </div>
      <form action="/user/request/register" method="POST" class="pt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="fullName" placeholder="Full Name" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email Address" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" />
            </div>
          </div>
          <div class="col-md-12">
            <p class="agree-privacy">
              By clicking the Sign Up button below you agreed to our privacy
              policy and terms of use of our website.
            </p>
          </div>
          <div class="col-md-6">
            <span class="go-login">Already a member? <a href="/user/login">Sign In</a></span>
          </div>
          <div class="col-md-6 text-right">
            <div class="form-group">
              <button type="submit" class="btn btn-primary sign-up">
                Sign Up
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-6 auth-bg-image d-flex justify-content-center align-items-center">
    <div class="auth-left-content mt-5 mb-5 text-center">
      <div class="weather-small text-white">
        <p class="current-weather">
          <i class="bx bx-sun"></i> <span>14&deg;</span>
        </p>
        <p class="weather-city">Gyumri</p>
      </div>
      <div class="text-white mt-5 mb-5">
        <h2 class="create-account mb-3">Create Account</h2>
        <p>Enter your personal details and start journey with us.</p>
      </div>
      <div class="auth-quick-links">
        <a href="#" class="btn btn-outline-primary">Purchase template</a>
      </div>
    </div>
  </div>
</div>