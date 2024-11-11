<div class="seperate_header"></div>

<?php
if ($data['isLogin']): ?>
  <a href="/account/?username=' . $_SESSION['username'] . '" style="text-decoration: none">Account</a>
<?php else: ?>
  <a href="account.php" style="text-decoration: none">Account</a>
<?php endif; ?>

<?php
if (!isset($_SESSION['username'])) {
  echo '<a href="/" style="text-decoration: none;">Login</a>';
} else {
  echo '<a href="back/logout.php"  style="text-decoration: none;">Logout</a>';
}
?>


<div class="login-signup">
  <center><img class="login-logo" src="logo/Minglr logo3.png" alt="logo"></center>
  <center><small><button class="btn"
        onclick="getElementById('login-form').style.display='block'; getElementById('regst-form').style.display='none';">Login</button>OR<button
        class="btn"
        onclick="getElementById('login-form').style.display='none'; getElementById('regst-form').style.display='block';">Register</button></small>
  </center>
  <div class="login">
    <form action="db/validate.php" method="post" class="login-form" id="login-form">
      <input type="text" for="usrname" id="username" autocomplete="off" name="username" placeholder="Username" required>
      <input type="password" for="password" id="password" name="password" placeholder="Password" autocomplete="off"
        required>
      <button class="login-btn" name="lgn" id="lgn">Login Now</button>
    </form>
  </div>
  <div class="register">
    <form action="db/validate.php" method="post" class="regst-form" id="regst-form" style="display: none;">
      <input type="text" for="usrname" id="usrname" name="username" placeholder="Username" autocomplete="off" required>
      <section class="name">
        <input type="text" for="fname" id="fname" name="fname" placeholder="First name" required pattern="[a-zA-Z]{2,}$"
          title="please enter alphabets only">
        <input type="text" for="lname" id="lname" name="lname" placeholder="Last name" required pattern="[a-zA-Z]{2,}$"
          title="please enter alphabets only">
      </section>
      <input type="email" for="email" id="email" name="email" placeholder="Email" required>
      <input type="password" id="pass" name="password" placeholder="Password" required>
      <!--only show for password input -->
      <div class="div-toggle-password">
        <button id="togglePassword" hidden>Show</button>
        <small id="kindOfPassword" hidden>
          <span>🔒 size > 8 </span>
          <span>🔠 Uppercase </span>
          <span>🔡 Lowercase </span>
          <span>🔢 Number </span>
          <span>@!$# Special Character</span>
        </small>
      </div>
      <small>Your data will be used to provide you with the seamless experience. We respect your
        privacy</small>
      <button class="rgst-btn" name="regst" id="regst" style="cursor: not-allowed;" disabled>Register</button>
    </form>
  </div>
</div>