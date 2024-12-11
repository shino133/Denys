<?php
$self_avatarUrl = Auth::getUser()['avatar_url'] ?? '';
$self_fullName = Auth::getUser()['full_name'] ?? 'Anonymous';
?>

<div class="row bootstrap snippets">
  <div class="col-md-12">
    <div class="comment-wrapper">
      <div class="panel panel-info">
        <div class="p-2">
          <ul class="media-list comments-list">
            <li class="media comment-form">
              <a href="/user/profile" class="pull-left">
                <?php if ($self_avatarUrl) : ?>
                  <img src="<?= "/assets/img/users/$self_avatarUrl" ?>" alt="Online user" class="mr-3 post-user-image"
                    style="height: 30px; width: 30px;" />
                <?php else : ?>
                  <div class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image"
                    style="height: 30px; width: 30px;"><span class=""><?= strtoupper($self_fullName)[0] ?></span></div>
                <?php endif; ?>
              </a>
              <div class="media-body">
                <?php AppLoader::component("Comment/Form", ["postId" => $postId]) ?>

                <div class="bg-transparent mh-100 w-30 d-flex justify-content-center">
                  <img id="commentImagePreview" src="" alt="Image Preview" class="border-card m-3"
                    style="max-width: 100%; display: none;">
                </div>
              </div>
            </li>



            <?php foreach ($comments as $comment) : ?>
              <li class="media">
                <?php AppLoader::component("Comment/Item", ['comment' => $comment,
                  'postId' => $postId]) ?>
              </li>
            <?php endforeach; ?>

            <li class="media">
              <div class="media-body">
                <div class="comment-see-more text-center">
                  <a href="/" class="btn btn-link fs-8">
                    Quay lại bảng tin
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>