<!DOCTYPE html>
<html lang="en">

<head>
  <?php AppLoader::component(path: "Layout/Head/main") ?>
</head>

<body class="p-0 <?= Store::get('bodyClass') ?>">

  <?php if ($useBaseLayout) {
    AppLoader::view(path: $pathLayout, data: [
      "data" => $data,
      "pathView" => $pathView
    ]);
  } else {
    AppLoader::view(path: $pathView, data: $data);
  }?>

  <?php Script::render(position: 'body'); ?>
</body>

</html>