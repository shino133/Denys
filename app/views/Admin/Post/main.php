<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
      <h6 class="text-white text-capitalize ps-3">Danh sách bài viết</h6>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và Tên</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người dùng</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bình luận</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lượt thích</th>
            <th class="text-secondary opacity-7">
              <div class="d-flex justify-content-center align-items-center">
                <button type="button" onClick="window.location.reload();" class="btn m-0 text-warning font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">refresh</i>
                  <span>Refresh</span>
                </button>
                <a href="/admin/team-manager/add" class="text-info font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">add</i>
                  <span>Thêm</span>
                </a>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($postData as $data): ?>
            <tr>
              <!-- Ảnh -->
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <img src="/assets/img/<?= htmlspecialchars($data['post_mediaUrl']) ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="user image">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm"><?= htmlspecialchars($data['user_fullName']) ?></h6>
                  </div>
                </div>
              </td>
              <!-- Người dùng -->
              <td>
                <a href="/@<?= htmlspecialchars($data['user_userName']) ?>" class="text-sm text-secondary mb-0" target="_blank">
                  @<?= htmlspecialchars($data['user_userName']) ?>
                </a>
              </td>
              <!-- Ngày tạo -->
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold"><?= htmlspecialchars($data['post_createdAt']) ?></span>
              </td>
              <!-- Bình luận -->
              <td class="align-middle text-center">
                <?php if (!empty($data['commentCount']) && is_array($data['commentCount'])): ?>
                  <ul class="list-unstyled mb-0">
                    <?php foreach ($data['commentCount'] as $comment): ?>
                      <li class="text-xs text-secondary"><?= htmlspecialchars($comment) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <span class="text-xs text-secondary">Không có bình luận</span>
                <?php endif; ?>
              </td>
              <!-- Lượt thích -->
              <td class="align-middle text-center">
                <?php if (!empty($data['likeCount']) && is_array($data['likeCount'])): ?>
                  <ul class="list-unstyled mb-0">
                    <?php foreach ($data['likeCount'] as $like): ?>
                      <li class="text-xs text-secondary"><?= htmlspecialchars($like) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <span class="text-xs text-secondary">Không có lượt thích</span>
                <?php endif; ?>
              </td>
              <!-- Hành động -->
              <td class="align-middle">
                <div class="d-flex justify-content-center align-items-center gap-3">
                  <a href="/admin/manager/group/edit" class="text-success font-weight-bold text-xs d-flex justify-content-center align-items-center">
                    <i class="material-symbols-rounded opacity-5">edit</i>
                    <span>Sửa</span>
                  </a>
                  <a href="/admin/manager/group/delete" class="text-danger font-weight-bold text-xs d-flex justify-content-center align-items-center">
                    <i class="material-symbols-rounded opacity-5">delete</i>
                    <span>Xóa</span>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>