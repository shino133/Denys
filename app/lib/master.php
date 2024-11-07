<?php
function app_include($path, $data = [])
{
  $fullPath = __DIR__ . '/../' . $path .".php";

  // Kiểm tra nếu file tồn tại trước khi include
  if (file_exists($fullPath)) {
    include_once $fullPath;
  } else {
    echo "File không tồn tại: $fullPath";
  }
}

function app_view($path, $data = [])
{
  app_include("views/$path", $data);
}

function app_model($path, $isIncludeBase = true)
{
  if ($isIncludeBase) {
    app_include("models/BaseModel");
  }
  app_include("models/$path");
}

function app_controller($path, $isIncludeBase = true)
{
  if ($isIncludeBase) {
    app_include("controllers/BaseController");
  }
  app_include("controllers/$path");
}

function app_feature($path)
{
  app_include("features/$path");
}

function app_helper($path)
{
  app_include("features/helpers/$path");
}

function app_component($path)
 {
  app_include("components/$path");
}