<?php
namespace App\Utils\Helpers;

class Loader
{
  private static $basePath;

  // Set base path for file inclusion
  public static function setBasePath($path)
  {
    self::$basePath = rtrim($path, '/');
  }

  public static function getBasePath()
  {
    return self::$basePath ?? (__DIR__.'/../../');
  }

  // Get full path of a file
  private static function getFullPath($path)
  {
    $basePath = self::$basePath ?? (__DIR__.'/../');
    return $basePath.'/'.ltrim($path, '/').'.php';
  }

  // Get file                
  private static function getFileFullPath($path, $data = [])
  {
    $fullPath = self::getFullPath($path);
    if (file_exists($fullPath)) {
      return [$fullPath, $data];
    } else {
      throw new \Exception("File not found: $fullPath");
    }
  }

  // Include file
  public static function include($path, $data = [], $includeOnce = true)
  {
    [$fullPath, $data] = self::getFileFullPath($path, $data);
    extract($data);
    return $includeOnce ? include_once $fullPath : include $fullPath;
  }

  // Require file
  public static function require($path, $data = [], $requireOnce = true)
  {
    [$fullPath, $data] = self::getFileFullPath($path, $data);
    extract($data, EXTR_SKIP);
    return $requireOnce ? require_once $fullPath : require $fullPath;
  }
}
