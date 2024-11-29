<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href="<?= BASE_URL_ADMIN . "dashboard" ?>">
      <img src="/public/logo/logo-64x64.png" class="navbar-brand-img" width="32" height="32" alt="main_logo" />
      <span class="ms-1 text-sm text-dark">Denys Admin</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2" />
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/dashboard">
          <i class="material-symbols-rounded opacity-5">dashboard</i>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/manager/user">
          <i class="material-symbols-rounded opacity-5">supervisor_account</i>
          <span class="nav-link-text ms-1">Quản lý người dùng</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/manager/post">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Quản lý bài viết</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/manager/group">
          <i class="material-symbols-rounded opacity-5">group</i>
          <span class="nav-link-text ms-1">Quản lý nhóm</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/manager/event">
          <i class="material-symbols-rounded opacity-5">event</i>
          <span class="nav-link-text ms-1">Quản lý sự kiện</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-dark" href="../pages/notifications.html">
          <i class="material-symbols-rounded opacity-5">notifications</i>
          <span class="nav-link-text ms-1">Notifications</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">
          Account pages
        </h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/team-manager">
          <i class="material-symbols-rounded opacity-5">shield_person</i>
          <span class="nav-link-text ms-1">Phân quyền quản trị</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/admin/user/settings">
          <i class="material-symbols-rounded opacity-5">settings</i>
          <span class="nav-link-text ms-1">Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/logout">
          <i class="material-symbols-rounded opacity-5">logout</i>
          <span class="nav-link-text ms-1">logout</span>
        </a>
      </li>
    </ul>
  </div>
</aside>