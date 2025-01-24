<?php

namespace App\Features;

use App\Utils\Helpers\Store;

class Pagination
{
  /**
   * Validate a specific pagination parameter.
   *
   * @param array $params The parameters array.
   * @param string $key The parameter key to validate ('page' or 'perPage').
   * @return bool True if the parameter is valid, false otherwise.
   */
  private static function validatePageParam(array $params, string $key): bool
  {
    return isset($params[$key])
      && is_numeric($params[$key])
      && $params[$key] > 0;
  }

  /**
   * Get pagination data.
   *
   * @param array|null $params Optional parameters array. If null, retrieves query params from Store.
   * @return array ['page' => int, 'perPage' => int]
   */
  public static function get(array $params = null): array
  {
    $params ??= Store::getQueryParams();

    $page = self::validatePageParam($params, 'page')
      ? (int) $params['page']
      : 1;

    $perPage = self::validatePageParam($params, 'perPage')
      ? (int) $params['perPage']
      : 10;

    return [
      'page' => $page,
      'perPage' => $perPage,
    ];
  }
}
