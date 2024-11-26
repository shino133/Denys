<ul class="list-unstyled" style="margin-bottom: 0">
  <li class="media post-form w-shadow">
    <div class="media-body">
      <form action="/post/request/add" method="post" enctype="multipart/form-data">
        <div class="form-group post-input">
          <textarea name="content" class="form-control" id="postForm" rows="3"
            placeholder="Bạn cảm thấy hôm nay thế nào<?= Store::get('username') ?>?"></textarea>
          <div class="bg-light mh-100 w-full d-flex justify-content-center">
            <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; display: none;">
          </div>
          <input class="form-control form-control-sm" id="postImage" name="post_image" type="file" hidden />
        </div>
        <div class="row post-form-group">
          <div class="col-md-9">
            <label for="postImage" class="form-label post-form-btn cursor-pointer">
              <i class="bx bx-images"></i> <span>Photo</span>
            </label>
            <button type="button" class="btn btn-link post-form-btn btn-xl">
              <i class="bx bxs-group"></i> <span>Tag Friends</span>
            </button>
            <button type="button" class="btn btn-link post-form-btn btn-xl">
              <i class="bx bxs-map"></i> <span>Check In</span>
            </button>
          </div>
          <div class="col-md-3 text-right">
            <button type="submit" class="btn btn-primary btn-xl">
              Publish
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>
</ul>