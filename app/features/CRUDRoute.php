<?php

namespace App\Features;

use App\Utils\Helpers\Route;

class CRUDRoute
{
  /**
   * Set CRUD routes with default or custom actions.
   *
   * @param string $url The base URL for the resource.
   * @param string $controller The controller name.
   * @param array $actionList An optional array to override default actions.
   */
  public static function set(string $url, string $controller, array $actionList = []): void
  {
    // Default action map
    $defaultActions = [
      'index' => ['method' => 'get', 'path' => "{$url}", 'action' => "{$controller}@index"],
      'getData' => ['method' => 'get', 'path' => "{$url}/{id}", 'action' => "{$controller}@getData"],
      'editPage' => ['method' => 'get', 'path' => "{$url}/{id}/edit", 'action' => "{$controller}@editPage"],
      'editData' => ['method' => 'post', 'path' => "{$url}/{id}/edit/request", 'action' => "{$controller}@editData"],
      'addPage' => ['method' => 'get', 'path' => "{$url}/add", 'action' => "{$controller}@addPage"],
      'addData' => ['method' => 'post', 'path' => "{$url}/add/request", 'action' => "{$controller}@addData"],

      'destroyData' => ['method' => 'get', 'path' => "{$url}/{id}/destroy/request", 'action' => "{$controller}@destroyData"],
    ];

    // Merge default actions with custom actions
    $actions = array_merge($defaultActions, self::mapCustomActions($actionList, $controller, $url));

    // Register routes
    foreach ($actions as $action) {
      call_user_func([Route::class, $action['method']], $action['path'], $action['action']);
    }
  }

  /**
   * Map custom actions provided in $actionList to the route structure.
   *
   * @param array $actionList Custom actions to override.
   * @param string $controller Controller name.
   * @param string $url Base URL.
   * @return array Mapped actions.
   */
  private static function mapCustomActions(array $actionList, string $controller, string $url): array
  {
    $customActions = [];
    foreach ($actionList as $key => $customMethod) {
      $customActions[$key] = match ($key) {
        'index' => ['method' => 'get', 'path' => $url, 'action' => "{$controller}@{$customMethod}"],
        'getData' => ['method' => 'get', 'path' => "{$url}/{id}", 'action' => "{$controller}@{$customMethod}"],
        'editPage' => ['method' => 'get', 'path' => "{$url}/{id}/edit", 'action' => "{$controller}@{$customMethod}"],
        'editData' => ['method' => 'post', 'path' => "{$url}/{id}/edit/request", 'action' => "{$controller}@{$customMethod}"],
        'addPage' => ['method' => 'get', 'path' => "{$url}/add", 'action' => "{$controller}@{$customMethod}"],
        'addData' => ['method' => 'post', 'path' => "{$url}/add/request", 'action' => "{$controller}@{$customMethod}"],
        'destroyData' => ['method' => 'post', 'path' => "{$url}/{id}/destroy/request", 'action' => "{$controller}@{$customMethod}"],
        default => null, // Không xử lý các key không nằm trong danh sách trên
      };

      // Loại bỏ key không hợp lệ
      if ($customActions[$key] === null) {
        unset($customActions[$key]);
      }
    }
    return $customActions;
  }

}
