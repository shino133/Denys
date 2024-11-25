<!DOCTYPE html>
<html lang="en">

<head>
  <?php AppLoader::component(path: "Layout/Head/main") ?>
</head>

<body <?= Store::get('bodyClass') ? ' class="' . Store::get('bodyClass') . '"' : '' ?>>

  <?php AppLoader::view(path: $data['pathView'], data: $data) ?>

  <?php Script::render(position: 'body'); ?>
</body>

</html>