<?php

// dumpVar($userData);

?>

<?php if (isset($userData) && count($userData) > 0) : ?>
  <?php foreach (array_chunk($userData, 4) as $userChunk) : // Nhóm mỗi 4 user thành 1 mảng con ?>
    <div class="row">
      <?php foreach ($userChunk as $user) : ?>
        <div class="col-md-3 col-sm-6">
          <div class="card group-card shadow-sm">
            <img src="/assets/img/users/<?= htmlspecialchars($user['avatarUrl'], ENT_QUOTES, 'UTF-8') ?>"
              class="card-img-top group-card-image" style="width: 100%; height: 150px;" alt="User image" />
            <div class="card-body">
              <h5 class="card-title">
                <?= htmlspecialchars($user['fullName'], ENT_QUOTES, 'UTF-8') ?>
              </h5>
              <a href="/@<?= htmlspecialchars($user['userName'], ENT_QUOTES, 'UTF-8') ?>"
                class="card-text">@<?= htmlspecialchars($user['userName'], ENT_QUOTES, 'UTF-8') ?></a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>