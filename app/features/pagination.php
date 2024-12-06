<?php
function pagination($params = []) {
  $params ??= Store::getQueryParams();

  function validatePageParams($params, $var)
  {
    return isset($params, $params[$var]) && is_numeric($params[$var]) && $params[$var] > 0;
  }

  $page = validatePageParams($params, 'page')
    ? $params['page']
    : 1;

  $perPage = validatePageParams($params, 'perPage')
    ? $params['perPage']
    : 10;

    return [
      'page' => $page , 
      'perPage' => $perPage];
}