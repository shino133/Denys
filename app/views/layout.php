<!DOCTYPE html>
<html lang="en">

<head>
  <?php AppLoader::component("Head/main") ?>
</head>

<body>
  <header>
    <?php AppLoader::component("Header/main") ?>
  </header>

  <main>
    <?php AppLoader::view($data['pathView'], $data) ?>
  </main>

  <footer>
    <?php AppLoader::component("Footer/main") ?>
  </footer>
</body>
</html>