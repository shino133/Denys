<!DOCTYPE html>
<html lang="en">

<head>
  <?php AppLoader::component(path: "Head/main") ?>
</head>

<body>

  <div id="root">
    <?php AppLoader::view(path: $data['pathView'], data: $data) ?>
  </div>

  <?php Script::renderScripts(position: 'body'); ?>
</body>
</html>