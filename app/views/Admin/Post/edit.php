<?php

$baseUrl ??= "/admin/manager/post";
// dumpVar($post);

?>
<div class="row">
  <!-- Header  -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Quản lý bài viết</h3>
    <p class="mb-4">
      Sửa bài viết
    </p>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3">
            <a href="<?= $baseUrl ?>" class="text-white d-flex align-items-center ps-3 gap-1">
              <i class="material-symbols-rounded opacity-5">keyboard_backspace</i>
              <span class="text-capitalize ">Back</span>
            </a>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="card card-plain">
            <div class="card-body">
              <form action=<?= "$baseUrl/" . $post['post_id'] . "/edit/request"?> method="post" enctype="multipart/form-data">

                <!-- fullName  -->
                <div class="form-text text-danger text-end" id="error-fullName"></div>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" name="fullName" value="<?= $post['user_fullName'] ?>" class="form-control text-secondary"
                    disabled>
                </div>

                <!-- userName  -->
                <div class="form-text text-danger text-end" id="error-fullName"></div>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" name="userName" value="@<?= $post['user_userName'] ?>" class="form-control text-secondary" disabled>
                </div>

                <div class="form-text text-danger text-end" id="error-content"></div>
                <div class="input-group input-group-outline mb-3">
                  <textarea class="form-control" name="content" id="content" rows="5"
                    placeholder="Nội dung"><?= $post['post_content'] ?></textarea>
                </div>


                <!-- image  -->
                <div class="form-text text-danger text-end" id="error-image"></div>
                <div class="input-group input-group-outline mb-3">
                  <input type="file" name="mediaUrl" class="form-control" id="userImage">
                  <div class="row w-100 d-flex justify-content-center">
                    <?php if ($post['post_mediaUrl'] != null) : ?>
                      <img id="userImagePreview" src="/assets/img/<?= $post['post_mediaUrl'] ?>" value="<?= $post['post_mediaUrl'] ?>" alt="Image Preview"
                        class="w-30">
                    <?php else : ?>
                      <img id="userImagePreview" src="" alt="Image Preview" class="w-30" style="display: none">
                    <?php endif; ?>
                  </div>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="active" name="status" id="status" <?= $post['post_status'] == 'active' ? 'checked' : '' ?> />
                  <label class="form-check-label" for="status">Active</label>
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
    </div>
  </div>
</div>