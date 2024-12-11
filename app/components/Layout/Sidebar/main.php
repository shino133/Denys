<?php
$menuItems = Constants::sidebarHomePage();
?>

<div class="card newsfeed-user-card h-100 rounded mr-3">
  <ul class="list-group list-group-flush newsfeed-left-sidebar list-links">
    <li class="list-group-item">
      <h6>Trang chủ</h6>
    </li>
    <?php foreach ($menuItems as $item) : ?>
      <li class="list-group-item d-flex justify-content-between align-items-center sidebar-links list-links-item <?= $item['extraClass'] ?>">
        <a href="<?= $item['link'] ?>" class="sidebar-item">
          <img src="<?= $item['icon'] ?>" alt="<?= strtolower($item['title']) ?>" />
          <?= $item['title'] ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>