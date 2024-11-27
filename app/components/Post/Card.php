<div class="media text-muted pt-3">
  <?php if ($user_avatarUrl): ?>
    <img src="<?= "/assets/img/users/$user_avatarUrl" ?>" alt="Online user" class="mr-3 post-user-image"
      style="height: 40px; width: 40px;" />
  <?php else: ?>
    <div class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image"
      style="height: 40px; width: 40px;"><span class=""><?= strtoupper($user_fullName)[0] ?></span></div>
  <?php endif; ?>

  <div class="media-body pb-3 mb-0 small lh-125">
    <div class="d-flex justify-content-between align-items-center w-100">
      <a href="<?= BASE_URL . "@$user_userName" ?>" class="text-gray-dark post-user-name"><?= $user_fullName ?></a>
      <div class="dropdown">
        <a href="#" class="post-more-settings" role="button" data-toggle="dropdown" id="postOptions"
          aria-haspopup="true" aria-expanded="false">
          <i class="bx bx-dots-horizontal-rounded"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left post-dropdown-menu">
          <a href="#" class="dropdown-item" aria-describedby="savePost">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-bookmark-plus post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Save post</span>
                <small id="savePost" class="form-text text-muted">Add this to your saved items</small>
              </div>
            </div>
          </a>
          <a href="#" class="dropdown-item" aria-describedby="hidePost">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-hide post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Hide post</span>
                <small id="hidePost" class="form-text text-muted">See fewer posts like this</small>
              </div>
            </div>
          </a>
          <a href="#" class="dropdown-item" aria-describedby="snoozePost">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-time post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Snooze Arthur for 30 days</span>
                <small id="snoozePost" class="form-text text-muted">Temporarily stop seeing
                  posts</small>
              </div>
            </div>
          </a>
          <a href="#" class="dropdown-item" aria-describedby="reportPost">
            <div class="row">
              <div class="col-md-2">
                <i class="bx bx-block post-option-icon"></i>
              </div>
              <div class="col-md-10">
                <span class="fs-9">Report</span>
                <small id="reportPost" class="form-text text-muted">I'm concerned about this
                  post</small>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <span class="d-block"><?= $timeAgo ?><i class="bx bx-globe ml-3"></i></span>
  </div>
</div>
<div class="mx-1">
  <p>
    <?= $post_content ?>
  </p>
</div>
<div class="d-block mt-3">
  <?php if ($post_mediaUrl): ?>
    <img src="<?= "/assets/img/posts/$post_mediaUrl" ?>" class="post-content border-content" alt="post image" />
  <?php endif; ?>
</div>
<div class="mb-3">
  <!-- Reactions -->
  <div class="argon-reaction">
    <button type="button" class="btn post-card-buttons like-btn <?= $isLikedByCurrentUser ? 'active' : '' ?>"
      id="reactions"><i class="bx bxs-like mr-2"></i><?= $likeCount ?></button>
  </div>
  <a href="<?= BASE_URL . "post/$post_id" ?>" class="btn post-card-buttons" id="show-comments"><i
      class="bx bx-message-rounded mr-2"></i>
    <?= $commentCount ?></a>
  <div class="dropdown dropup share-dropup">
    <a href="#" class="btn post-card-buttons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="bx bx-share-alt mr-2"></i> Share
    </a>
    <div class="dropdown-menu post-dropdown-menu">
      <a href="#" class="dropdown-item">
        <div class="row">
          <div class="col-md-2">
            <i class="bx bx-share-alt"></i>
          </div>
          <div class="col-md-10">
            <span>Share Now (Public)</span>
          </div>
        </div>
      </a>
      <a href="#" class="dropdown-item">
        <div class="row">
          <div class="col-md-2">
            <i class="bx bx-share-alt"></i>
          </div>
          <div class="col-md-10">
            <span>Share...</span>
          </div>
        </div>
      </a>
      <a href="#" class="dropdown-item">
        <div class="row">
          <div class="col-md-2">
            <i class="bx bx-message"></i>
          </div>
          <div class="col-md-10">
            <span>Send as Message</span>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>