<?php

use App\Features\AppLoader;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Store;

?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <?php AppLoader::component(path: "Layout/Head/main") ?>
</head>

<body class="<?= Store::get('bodyClass') ?>">

  <?php if ($useBaseLayout) {
    AppLoader::view(path: $pathLayout, data: [
      "data" => $data,
      "pathView" => $pathView
    ]);
  } else {               
    AppLoader::view(path: $pathView, data: $data);
  } ?>

  <?php Script::render(position: 'body'); ?>
</body>

</html>