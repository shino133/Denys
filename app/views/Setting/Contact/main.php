<?php

// dumpVar($extractDataDetails);

$baseUrl = "/user/settings/contact";
$profileData ??= [
  'id' => 0,
  'userId' => 0,
  'bannerUrl' => '',
  'location' => '',
  'website' => '',
  'socialAccounts' => '',
  'bio' => '',
  'status' => '',
  'createdAt' => '',
  'updatedAt' => ''
];

?>
<div class="row message-right-side-content">
  <div class="col-md-12">
    <div id="message-frame">
      <div class="message-sidepanel">
        <?php AppLoader::component("Setting/LeftSide"); ?>
      </div>

      <div class="content">
        <div class="settings-form p-4">
          <h2>Thông tin liên hệ</h2>
          <form action="<?= $baseUrl ?>/request" method="POST" class="mt-4 settings-form">
            <div class="col-md-6">
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" value="<?= $profileData['profile_website'] ?>" name="website"
                  id="website" placeholder="Nhập Website của bạn" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="location">Địa chỉ</label>
                <input type="email" class="form-control" value="<?= $profileData['profile_location'] ?>" name="location"
                  id="location" placeholder="Nhập địa chỉ của bạn" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="bio">Giới hiệu</label>
                <textarea class="form-control" name="bio" id="bio" rows="4" placeholder="Một chút thông tin về bạn"><?= $profileData['profile_bio'] ?? '' ?></textarea>
              </div>
            </div>

            <h3 class="my-4">Các tài khoản khác</h3>

            <div class="col-md-6">
              <div class="form-row mb-3 align-items-center">
                <div class="col">
                  <label for="facebook">Facebook</label>
                  <input type="text" class="form-control" value="<?= $profileData['profile_socialAccounts']['facebook'] ?? '' ?>"
                    name="facebook" id="facebook" placeholder="https://www.facebook.com/tennguoidung" />
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-row mb-3 align-items-center">
                <div class="col">
                  <label for="instagram">Instagram</label>
                  <input type="text" class="form-control"
                    value="<?= $profileData['profile_socialAccounts']['instagram'] ?? '' ?>" name="instagram" id="instagram"
                    placeholder="https://www.instagram.com/tennguoidung" />
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-row mb-3 align-items-center">
                <div class="col">
                  <label for="tiktok">TikTok</label>
                  <input type="text" class="form-control" value="<?= $profileData['profile_socialAccounts']['tiktok'] ?? '' ?>"
                    name="tiktok" id="tiktok" placeholder="https://www.tiktok.com/@tennguoidung" />
                </div>
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