<?
$lastPage ??= 1;
$currentPage ??= 1;
$baseUrl ??= '#';
$nextPage ??= min($currentPage + 1, $lastPage);
$previousPage ??= max($currentPage - 1, 1);

?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="<?= $baseUrl ?>?page=<?= $previousPage ?>">
        <i class="material-symbols-rounded opacity-5">arrow_back</i>
      </a>
    </li>
    <?php for ($i = 1; $i <= $lastPage; $i++): ?>
      <li class="page-item">
        <a class="page-link <?= $currentPage == $i ? 'active' : '' ?>" href="<?= $baseUrl ?>?page=<?= $i ?>">
          <?= $i ?>
        </a>
      </li>
    <?php endfor; ?>
    <li class="page-item">
      <a class="page-link" href="<?= $baseUrl ?>?page=<?= $nextPage ?>">
        <i class="material-symbols-rounded opacity-5">arrow_forward</i>
      </a>
    </li>
  </ul>
</nav>