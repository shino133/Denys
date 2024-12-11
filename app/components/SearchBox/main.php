<?php

$isNav ??= false;

?>
<form class="w-30 mx-2 my-auto rounded d-inline form-inline mr-5 flex-grow-1" action="/search" method="GET" id="<?= $isNav ? "search-form-nav" : "search-form"?>">
  <div class="input-group">
    <input type="text" class="form-control search-input w-75" name="kw" id="<?= $isNav ? "search-input-nav" : "search-input"?>"
      placeholder="Tìm kiếm bạn bè, nhóm và sự kiện.." aria-label="Search" aria-describedby="search-addon" />
    <div class="input-group-append">
      <button class="btn search-button" type="<?= $isNav ? "submit" : "button"?>"  id="<?= $isNav ? "search-form-btn-nav" : "search-form-btn"?>">
        <i class="bx bx-search"></i>
      </button>
    </div>
  </div>
</form>