<?php
class SearchController extends BaseController
{
  public static function index()
  {
    Constants::searchPage();

    self::render('Search/main');
  }

  public static function searchData()
  {
    AppLoader::util('ApiHandler');
    AppLoader::lib('htmlToString');
    AppLoader::model('UserModel');

    $reqData = ApiHandler::getRequestData();
    $kw = $reqData['kw'] ?? null;
    if (empty($kw) || empty($reqData)) {
      ApiHandler::sendError('Invalid request', 400);
      return;
    }

    $column = $kw[0] == '@' ? 'userName' : 'fullName';
    $kw = substr($kw, 1);
    $limit = max(10, (int) ($reqData['limit'] ?? 0));

    $userData = self::searchUser(keyword: $kw, column: $column, limit: $limit);

    ob_start();
    AppLoader::component('SearchBox/UserCardGroup', [
      'userData' => $userData,
    ]);
    $html = ob_get_clean();
    $json = ['message' => 'Successfully'];

    ApiHandler::sendJson([
      'html' => $html,
      'json' => $json,
    ]);
    return;
  }

  public static function searchUser($keyword = null, $column = 'userName', $limit = 10)
  {
    AppLoader::model('UserModel');

    return UserModel::search(keyword: [
      $column => $keyword,
    ], op: 'OR', limit: $limit);
  }

  public static function searchPost($keyword = null)
  {
    AppLoader::model('PostModel');

    return PostModel::search([
      'title' => $keyword,
      'content' => $keyword
    ], op: 'OR');
  }

  public static function searchByCharacter($kw = null)
  {
    $char = self::specialCharacter($kw[0]);

    if (isset($char) == false)
      return [];

    $kw = substr($kw, 1);
    return match ($char) {
      'user' => self::searchUser($kw),
      'post' => self::searchPost($kw),
      default => []
    };
  }

  public static function specialCharacter($char) : string|null
  {
    return match ($char) {
      '@' => 'user',
      '#' => 'post',
      default => null
    };
  }
}