<?php
// dumpVar($extractDataDetails);
$avatar_url = $userData['avatar_url'] ?? "";
$full_name = $userData['full_name'] ?? "Anonymous";
?>

<nav id="navbar-main" class="navbar navbar-expand-lg shadow-sm sticky-top">
  <div class="w-100 justify-content-md-center">
    <ul class="nav navbar-nav enable-mobile px-2">
      <li class="nav-item">
        <button type="button" class="btn nav-link p-0">
          <img src="/public/img/icons/theme/post-image.png" class="f-nav-icon" alt="Quick make post" />
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
          <img src="/public/img/icons/navbar/message.png" class="message-dropdown f-nav-icon" alt="navbar icon" />
        </a>
      </li>
    </ul>
    <ul class="navbar-nav mr-5 flex-row" id="main_menu">
      <a class="navbar-brand nav-item mr-lg-5" href="/"><img src="/public/logo/logo-64x64.png" width="40" height="40"
          class="mr-3" alt="Logo" /></a>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <form class="w-30 mx-2 my-auto d-inline form-inline mr-5">
        <div class="input-group">
          <input type="text" class="form-control search-input w-75"
            placeholder="Search for people, companies, events and more..." aria-label="Search"
            aria-describedby="search-addon" />
          <div class="input-group-append">
            <button class="btn search-button" type="button">
              <i class="bx bx-search"></i>
            </button>
          </div>
        </div>
      </form>
      <li class="nav-item s-nav dropdown d-mobile">
        <a href="#" class="nav-link nav-icon nav-links drop-w-tooltip" data-toggle="dropdown" data-placement="bottom"
          role="button" aria-haspopup="true" aria-expanded="false">
          <img src="/public/img/icons/navbar/create.png" alt="navbar icon" />
        </a>
        <div class="dropdown-menu dropdown-menu-right nav-dropdown-menu">
          <a href="#" class="dropdown-item" aria-describedby="createGroup">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-group post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Group</span>
                <small id="createGroup" class="form-text text-muted">Tìm những người có chung sở thích</small>
              </div>
            </div>
          </a>
          <a href="#" class="dropdown-item" aria-describedby="createEvent">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-calendar post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Event</span>
                <small id="createEvent" class="form-text text-muted">Gắn kết mọi người lại với nhau thông qua một sự
                  kiện công cộng hoặc riêng tư</small>
              </div>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item s-nav dropdown message-drop-li">
        <a href="#" class="nav-link nav-links message-drop drop-w-tooltip" data-toggle="dropdown"
          data-placement="bottom" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="/public/img/icons/navbar/message.png" class="message-dropdown" alt="navbar icon" />
          <span class="badge badge-pill span-badge text-white">1</span>
        </a>
        <ul class="dropdown-menu notify-drop dropdown-menu-right nav-drop">
          <div class="notify-drop-title">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6 fs-8">
                Tin Nhắn | <a href="#">Yêu cầu</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="#" class="notify-right-icon">
                  Đánh dấu tất cả là đã đọc
                </a>
              </div>
            </div>
          </div>
          <!-- end notify title -->
          <!-- notify content -->
          <div class="drop-content">
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-6.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Susan P. Jarvis</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <i class="bx bx-check"></i> Cái tiệc này sẽ có DJ, đồ ăn, và đồ uống.
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-5.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Ruth D. Greene</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">"Tuyệt vời, hẹn gặp bạn ngày mai!".</p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-7.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Kimberly R. Hatfield</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">"Ừ, tôi sẽ có mặt ở đó.".</p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-8.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Joe S. Feeney</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  Tôi thật sự muốn mang bạn tôi, Jake, theo, nếu...
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-9.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">William S. Willmon</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">"Cảm ơn, tôi có thể giúp gì cho bạn?"</p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-10.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Sean S. Smith</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">Cảm ơn, tôi có thể giúp gì cho bạn?</p>
              </div>
            </li>
          </div>
          <div class="notify-drop-footer text-center">
            <a href="#">xem thêm</a>
          </div>
        </ul>
      </li>
      <li class="nav-item s-nav dropdown notification">
        <a href="#" class="nav-link nav-links rm-drop-mobile drop-w-tooltip" data-toggle="dropdown"
          data-placement="bottom" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="/public/img/icons/navbar/notification.png" class="notification-bell" alt="navbar icon" />
          <span class="badge badge-pill span-badge text-white">3</span>
        </a>
        <ul class="dropdown-menu notify-drop dropdown-menu-right nav-drop">
          <div class="notify-drop-title">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6 fs-8">
                Thông báo
                <span class="badge badge-pill span-badge text-white ml-2">3</span>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="#" class="notify-right-icon">
                  Đánh dấu tất cả là đã đọc
                </a>
              </div>
            </div>
          </div>
          <!-- end notify title -->
          <!-- notify content -->
          <div class="drop-content">
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-10.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Sean</a>
                <span class="notification-type">"Đã trả lời bình luận của bạn trên một bài đăng trong..." </span><a
                  href="#" class="notification-for">PHP</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bxs-group"></i></span>
                  3h
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-7.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Kimberly</a>
                <span class="notification-type">"Thích bình luận của bạn 'Tôi thật sự muốn...'"
                </span>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bxs-like"></i></span>
                  7h
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-8.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <span class="notification-type">"10 người đã xem câu chuyện của bạn trước khi nó biến mất. Xem ai đã xem
                  nó.".</span>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bx-images"></i></span>
                  23h
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-11.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Michelle</a>
                <span class="notification-type">Đăng trong </span><a href="#" class="notification-for">Hệ thống xã hội
                  Argon</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bxs-quote-right"></i></span>
                  1d
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-5.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Karen</a>
                <span class="notification-type">Chắc chắn, ở đây...
                </span>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bxs-like"></i></span>
                  2d
                </p>
              </div>
            </li>
            <li>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="notify-img">
                  <img src="/public/img/users/user-12.png" alt="notification user image" />
                </div>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <a href="#" class="notification-user">Irwin</a>
                <span class="notification-type">Đăng trong </span><a href="#" class="notification-for">Themeforest</a>
                <a href="#" class="notify-right-icon">
                  <i class="bx bx-radio-circle-marked"></i>
                </a>
                <p class="time">
                  <span class="badge badge-pill span-badge text-white"><i class="bx bxs-quote-right"></i></span>
                  3d
                </p>
              </div>
            </li>
          </div>
          <div class="notify-drop-footer text-center">
            <a href="#">See More</a>
          </div>
        </ul>
      </li>
      <li class="nav-item s-nav dropdown d-mobile">
        <a href="#" class="nav-link nav-links nav-icon drop-w-tooltip" data-toggle="dropdown" data-placement="bottom"
          role="button" aria-haspopup="true" aria-expanded="false">
          <img src="/public/img/icons/navbar/flag.png" alt="navbar icon" />
        </a>
        <div class="dropdown-menu dropdown-menu-right nav-drop">
          <a class="dropdown-item" href="newsfeed-2.html">Bảng tin 2</a>
          <a class="dropdown-item" href="sign-in.html">Đăng Nhập</a>
          <a class="dropdown-item" href="sign-up.html">Đăng Kí</a>
        </div>
      </li>
      <li class="nav-item s-nav">
        <a href="/user/profile" class="nav-link nav-links">
          <div class="menu-user-image">
            <?php if ($avatar_url): ?>
              <img src="<?= "/assets/img/users/$avatar_url" ?>" alt="Online user" class="mr-3 post-user-image border shadow object-fit-cover"
                style="height: 40px; width: 40px;" />
            <?php else: ?>
              <div class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image border border-white shadow"
                style="height: 40px; width: 40px;"><span class=""><?= strtoupper($full_name)[0] ?></span></div>
            <?php endif; ?>
          </div>
        </a>
      </li>
      <li class="nav-item s-nav nav-icon dropdown">
        <a href="settings.html" data-toggle="dropdown" data-placement="bottom"
          class="nav-link settings-link rm-drop-mobile drop-w-tooltip" id="settings-dropdown"><img
            src="/public/img/icons/navbar/settings.png" class="nav-settings" alt="navbar icon" /></a>
        <div class="dropdown-menu dropdown-menu-right settings-dropdown shadow-sm" aria-labelledby="settings-dropdown">
          <a class="dropdown-item" href="#">
            <img src="/public/img/icons/navbar/help.png" alt="Navbar icon" />
            Trung tâm trợ giúp</a>
          <a class="dropdown-item" href="/user/settings">
            <img src="/public/img/icons/navbar/gear-1.png" alt="Navbar icon" />
            Cài Đặt Chung</a>

          <?php if (Auth::checkAdmin()): ?>
            <a class="dropdown-item" href="/admin/dashboard">
              <img src="/public/img/icons/navbar/logout.png" alt="Navbar icon" />
              Vào trang quản trị</a>
          <?php endif; ?>

          <?php if (Auth::checkLogin()): ?>
            <a class="dropdown-item logout-btn" href="/logout">
              <img src="/public/img/icons/navbar/logout.png" alt="Navbar icon" />
              Đăng Xuất</a>
          <?php else: ?>
            <a class="dropdown-item logout-btn" href="/user/login">Đăng Nhập</a>
            <a class="dropdown-item logout-btn" href="/user/register">Đăng Kí</a>
          <?php endif; ?>
        </div>
      </li>
      <button type="button" class="btn nav-link" id="menu-toggle">
        <img src="/public/img/icons/theme/navs.png" alt="Navbar navs" />
      </button>
    </ul>
  </div>
</nav>