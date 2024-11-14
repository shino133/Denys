<!DOCTYPE html>
<html lang="en">

<head>
  <?php AppLoader::component(path: "Head/main") ?>
</head>

<body>
  <?php AppLoader::view(path: $data['pathView'], data: $data) ?>

  <?php Script::renderScripts(position: 'body'); ?>
</body>
</html>