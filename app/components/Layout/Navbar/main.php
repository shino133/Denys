<?php
// dumpVar($extractDataDetails);

use App\Features\Auth;

$avatar_url = $userData['avatar_url'] ?? "";
$full_name = $userData['full_name'] ?? "Anonymous";
?>

<nav id="navbar-main" class="navbar navbar-expand-lg shadow-sm sticky-top py-0">
  <div class="w-100 justify-content-md-center">
    <ul class="nav navbar-nav enable-mobile px-2">
      <li class="nav-item">
        <button type="button" class="btn nav-link p-0">
          <img src="/img/icons/theme/post-image.png" class="f-nav-icon" alt="Quick make post" />
        </button>
      </li>
      <li class="nav-item w-100 py-2">
        <form class="d-inline form-inline w-100 px-4">
          <div class="input-group">
            <input type="text" class="form-control search-input"
              placeholder="Search for people, companies, events and more..." aria-label="Search"
              aria-describedby="search-addon" />
            <div class="input-group-append">
              <button class="btn search-button" type="button">
                <i class="bx bx-search"></i>
              </button>
            </div>
          </div>
        </form>
      </li>
      <li class="nav-item">
        <a href="/messages" class="nav-link nav-icon nav-links message-drop drop-w-tooltip" data-placement="bottom">
          <img src="/img/icons/navbar/message.png" class="message-dropdown f-nav-icon" alt="navbar icon" />
        </a>
      </li>
    </ul>
    <ul class="navbar-nav mr-5 row" id="main_menu">
      <div class="col d-flex">
        <a class="navbar-brand nav-item" href="/"><img src="/logo/logo-64x64.png" width="60" height="60"
            alt="Logo" /></a>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="d-flex justify-content-center align-items-center px-2">
          <div class="bg-white rounded-pill p-1">
            <a class="p-1 d-flex justify-content-center align-items-center" href="/search">
              <span>Tìm kiếm</span>
              <i class='bx bx-search-alt-2 px-1' style="font-size: 20px;"></i>
            </a>
          </div>
        </div>
      </div>


      <div class="col d-flex justify-content-end">
        <li class="nav-item s-nav px-3">
          <a href="/user/profile" class="nav-link nav-links">
            <div class="menu-user-image">
              <?php if ($avatar_url) : ?>
                <img src="<?= "/assets/img/users/$avatar_url" ?>" alt="Online user"
                  class="mr-3 post-user-image border shadow object-fit-cover" style="height: 40px; width: 40px;" />
              <?php else : ?>
                <div
                  class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image border border-white shadow"
                  style="height: 40px; width: 40px;"><span class=""><?= strtoupper($full_name)[0] ?></span></div>
              <?php endif; ?>
            </div>
          </a>
        </li>
        <li class="nav-item s-nav nav-icon dropdown px-3">
          <a href="settings.html" data-toggle="dropdown" data-placement="bottom"
            class="nav-link settings-link rm-drop-mobile drop-w-tooltip" id="settings-dropdown"><img
              src="/img/icons/navbar/settings.png" class="nav-settings" alt="navbar icon" /></a>
          <div class="dropdown-menu dropdown-menu-right settings-dropdown shadow-sm"
            aria-labelledby="settings-dropdown">
            <a class="dropdown-item" href="#">
              <img src="/img/icons/navbar/help.png" alt="Navbar icon" />
              Trung tâm trợ giúp</a>
            <a class="dropdown-item" href="/user/settings">
              <img src="/img/icons/navbar/gear-1.png" alt="Navbar icon" />
              Cài Đặt Chung</a>

            <?php if (Auth::checkAdmin()) : ?>
              <a class="dropdown-item" href="/admin/dashboard">
                <img src="/img/icons/navbar/logout.png" alt="Navbar icon" />
                Vào trang quản trị</a>
            <?php endif; ?>

            <?php if (Auth::checkLogin()) : ?>
              <a class="dropdown-item logout-btn" href="/logout">
                <img src="/img/icons/navbar/logout.png" alt="Navbar icon" />
                Đăng Xuất</a>
            <?php else : ?>
              <a class="dropdown-item logout-btn" href="/user/login">Đăng Nhập</a>
              <a class="dropdown-item logout-btn" href="/user/register">Đăng Kí</a>
            <?php endif; ?>
          </div>
        </li>
        <button type="button" class="btn nav-link" id="menu-toggle">
          <img src="/img/icons/theme/navs.png" alt="Navbar navs" />
        </button>
      </div>

    </ul>
  </div>
</nav>