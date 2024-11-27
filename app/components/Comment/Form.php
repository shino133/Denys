<form action="/comment/request/add/<?= $postId ?>" method="POST" role="form" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12">
      <div class="input-group">
        <input type="text" class="form-control comment-input" name="content" placeholder="Viết bình luận" />
        <input type="file" id="commentImage" name="comment_image" hidden>

        <div class="input-group-btn ml-2">
          <button type="button" class="btn comment-form-btn" data-toggle="tooltip" data-placement="top"
            title="Tooltip on top">
            <i class="bx bxs-smiley-happy"></i>
          </button>
          <button type="button" class="btn comment-form-btn comment-form-btn" data-toggle="tooltip" data-placement="top"
            title="Tooltip on top">
            <i class="bx bx-camera"></i>
          </button>
          <label for="commentImage" class="btn comment-form-btn m-0" data-toggle="tooltip" data-placement="top"
            title="Tooltip on top">
            <i class="bx bx-file-blank"></i>
          </label>
          <button type="submit" class="btn comment-form-btn-send" data-toggle="tooltip" data-placement="top"
            title="Tooltip on top">
            <i class='bx bx-send'></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>