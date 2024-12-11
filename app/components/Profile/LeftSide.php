<?php

// dumpVar(var: $extractDataDetails, allowWrap: false, allowContinue: true);
// return;

$socialAccounts = $profileData['profile_socialAccounts'] ?? [];

AppLoader::lib('getFriendlyUrlName');
$isCurrentUser = $profileData['user_id'] == Auth::getUser('id');
?>
<div class="profile-info-left">
  <div class="text-center">

    <!-- Profile Image -->
    <div class="profile-img w-shadow">
      <?php if ($isCurrentUser) : ?>
        <div class="profile-img-overlay"></div>
      <?php endif; ?>

      <!-- Avatar -->
      <?php if (isset($profileData['user_avatarUrl'])) : ?>
        <img src="<?= "/assets/img/users/" . $profileData['user_avatarUrl'] ?>" alt="Avatar"
          class="avatar img-circle w-100 object-fit-cover" id="profileAvatar" />
      <?php else : ?>
        <div class="d-flex justify-content-center align-items-center bg-orange text-white avatar img-circle"
          style="height: 150px; width: 150px; font-size: 50px;" id="profileAvatar">
          <span><?= strtoupper($profileData['user_fullName'])[0] ?></span>
        </div>
      <?php endif; ?>

      <?php if ($isCurrentUser) : ?>
        <!-- Caption with Upload Button -->
        <form method="post" enctype="multipart/form-data" class="profile-img-caption" id="updateProfilePicForm"
          action="/user/profile/avatar/upload/request">
          <label for="updateProfilePicInput" class="upload">
            <i class="bx bxs-camera"></i> Cập nhật
            <input type="file" id="updateProfilePicInput" class="upload"
              accept="image/jpeg, image/png, image/gif, image/webp, image/jpg, image/svg" name="avatar" />
          </label>
        </form>
      <?php endif ?>
    </div>

    <p class="profile-fullname mt-3" id="profileFullName">
      <?= $profileData['user_fullName'] ?>
    </p>
    <p class="profile-username mb-3 text-muted">
      @<?= $profileData['user_userName'] ?>
    </p>
  </div>

  <?php if ($isCurrentUser == false) : ?>
    <div class="intro mt-4">
      <div class="row g-3">
        <?php if ($profileData['isFollowing'] == false) : ?>
          <button type="button" class="btn btn-outline-primary rounded-pill mx-2 col" id="followButton">
            <i class="bx bx-plus" id="followButtonIcon"></i>
            <span id="followButton@<?= $profileData['user_userName'] ?>">Follow</span>
          </button>
        <?php else : ?>
          <button type="button" class="btn btn-outline-primary rounded-pill mx-2 col followed" id="followButton">
            <i class="bx bx-check" id="followButtonIcon"></i>
            <span id="followButton@<?= $profileData['user_userName'] ?>">Following</span>
          </button>
        <?php endif; ?>

        <button type="button" class="btn btn-primary text-white rounded-pill mx-2 col" data-toggle="modal"
          data-target="#newMessageModal">
          <i class="bx bxs-message-rounded"></i>
          <span class="fs-8">Message</span>
        </button>
      </div>
    </div>
  <?php endif; ?>

  <div class="intro mt-4 mv-hidden">
    <hr />
    <div class="intro-item d-flex justify-content-between align-items-center m-0">
      <h3 class="intro-about">Giới thiệu</h3>
    </div>

    <div class="intro-item intro-title text-break text-center">
      <p>
        <?= $profileData['profile_bio'] ?>
      </p>
    </div>

    <div class="intro-item d-flex justify-content-between align-items-center">
      <p class="intro-title text-muted">
        <i class='bx bxl-chrome text-primary'></i> Website:
        <?php if ($profileData['profile_website']) : ?>
          <a href="<?= $profileData['profile_website'] ?>" target="_blank" rel="noopener noreferrer">Xem ngay</a>
        <?php else : ?>
          <span>Không có</span>
        <?php endif; ?>
      </p>
    </div>
    <div class="intro-item d-flex justify-content-between align-items-center">
      <p class="intro-title text-muted">
        <i class="bx bxs-map text-primary"></i> Địa chỉ
        <?php if ($profileData['profile_location']) : ?>
          <a href="https://www.google.com/search?q=<?= urlencode($profileData['profile_location']) ?>" target="_blank"
            rel="noopener noreferrer">Xem ngay</a>
        <?php else : ?>
          <span>Không có</span>
        <?php endif; ?>
      </p>
    </div>

    <?php if ($isCurrentUser) : ?>
      <div class="intro-item d-flex justify-content-between align-items-center">
        <a href="/user/settings/contact" class="btn btn-quick-link join-group-btn border w-100">
          Chỉnh sửa chi tiết
        </a>
      </div>
    <?php endif; ?>
  </div>

  <div class="intro mt-5 mv-hidden">
    <hr />
    <div class="intro-item d-flex justify-content-between align-items-center">
      <h4 class="intro-about">Các tài khoản khác</h4>
    </div>
    <?php if (empty($socialAccounts) == false) : ?>
      <?php foreach ($socialAccounts as $platform => $account) : ?>
        <?php $friendlyName = getFriendlyUrlName($account); ?>
        <div class="intro-item d-flex justify-content-between align-items-center">
          <p class="intro-title text-muted">
            <i class="bx bxl-<?= $platform ?> <?= $platform ?>-color"></i>
            <a href="<?= $account ?>" target="_blank" rel="nofollow noreferrer">
              <?= $friendlyName ?>
            </a>
          </p>
        </div>
      <?php endforeach; ?>

    <?php else : ?>
      <div class="pt-3">
        <div class="alert text-center rounded">
          Không có tài khoản nào
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>