<?php

$baseUrl ??= "/user/profile";

?>
<ul class="list-inline profile-links list-links rounded-bottom px-3 row mb-0 w-shadow overflow-hidden">
  <li class="list-inline-item list-links-item col text-center rounded-bottom">
    <a href="<?= $baseUrl ?>">Timeline</a>
  </li>
  <li class="list-inline-item list-links-item col text-center rounded-bottom">
    <a href="<?= $baseUrl ?>/following">Đang theo dõi</a>
  </li>
  <li class="list-inline-item list-links-item col text-center rounded-bottom">
    <a href="<?= $baseUrl ?>/followers">Người theo dõi</a>
  </li>
  <li class="list-inline-item list-links-item col text-center rounded-bottom">
    <a href="<?= $baseUrl ?>/photos">Photos</a>
  </li>
</ul>