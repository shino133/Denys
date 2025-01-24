<?php
namespace Core\Deny\Models;

use PDO;
use PDOException;
use RuntimeException;

class BaseModel
{
  protected static $pdo;
  protected static $table;
  protected static $alias;

  protected static function pdo()
  {
    if (! self::$pdo) {
      try {
        // Cấu hình kết nối
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $username = DB_USER;
        $password = DB_PASSWORD;

        // Tùy chọn PDO
        $options = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Chế độ báo lỗi
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch kiểu associative array
          PDO::ATTR_PERSISTENT => true, // Sử dụng Persistent Connections
        ];

        // Khởi tạo PDO
        self::$pdo = new PDO($dsn, $username, $password, $options);
      } catch (PDOException $e) {
        // Xử lý lỗi kết nối
        throw new RuntimeException("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
      }
    }

    return self::$pdo;
  }


  // Truy vấn SQL
  protected static function query($sql, $params = [])
  {
    try {
      $stmt = self::pdo()->prepare($sql);

      foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
      }

      $stmt->execute();

      // Logging (tùy chọn)
      error_log("Executed query: $sql with params: " . json_encode($params));

      return $stmt;
    } catch (PDOException $e) {
      if (DEV_MODE) {
        // dumpVar(['sql' => $sql, 'params' => $params], allowWrap: true);
        error_log("Query error: " . $e->getMessage());
        throw $e;
      }

      return false;
    }
  }

  // Xây dựng SQL clause
  protected static function buildSqlClause(array $conditions, $clauseType = 'WHERE') : array
  {
    if (empty($conditions)) {
      return ['sql' => '', 'bindings' => []];
    }

    $sql = '';
    $bindings = [];
    $clauses = [];
    $connector = [
      'WHERE' => 'AND',
      'VALUES' => ',',
      'SET' => ',',
      'JOIN' => 'ON',
      'WHERE_OR' => 'OR',
    ][$clauseType] ?? 'AND';

    foreach ($conditions as $column => $value) {
      $placeholder = str_replace('.', '', ":$column");
      $clauses[] = "$column = $placeholder ";
      $bindings[$placeholder] = $value;
    }

    $sql = " $clauseType " . implode(" $connector ", $clauses);

    return ['sql' => $sql, 'bindings' => $bindings];
  }

  // Lấy tất cả bản ghi
  public static function fetchAll($sql, $params = []) : array
  {
    return self::query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  // Lấy một bản ghi
  public static function fetchOne($sql, $params = []) : mixed
  {
    return self::query($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  public static function fetchColumn($sql, $params = [])
  {
    return self::query($sql, $params)->fetchColumn();
  }

  // Lấy tất cả dữ liệu từ bảng hiện tại
  public static function read($columns = ['*'], $orderBy = null, $limit = null)
  {
    $columnString = implode(', ', $columns);
    $sql = "SELECT $columnString FROM " . static::$table . " ";

    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    $params = [];
    if ($limit) {
      $sql .= " LIMIT :limit";
      $params[':limit'] = $limit;
    }

    // dumpVar(['sql' => $sql, 'params' => $params]);

    return self::fetchAll($sql, $params);
  }

  // Phương thức để tìm bản ghi theo điều kiện
  public static function find($conditions = [], $columns = ['*'], $limit = null, $orderBy = null, $offset = null, $include_alias = false) : array
  {
    $columnsList = implode(', ', $columns);
    $sql = "SELECT $columnsList FROM " . static::$table . " ";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // Thêm LIMIT với OFFSET
    $params = $whereData['bindings'];
    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    if ($limit) {
      $sql .= " LIMIT " . (int) $limit;
    }

    if ($offset) {
      $sql .= " OFFSET " . (int) $offset;
    }


    // dumpVar(['sql' => $sql, 'params' => $params]);

    $res = self::fetchAll($sql, $params);

    if ($include_alias) {
      foreach ($res as &$row) {
        foreach ($row as $key => $value) {
          $row[static::$alias . '_' . $key] = $value;
          unset($row[$key]); // Xóa khóa cũ
        }
      }
      unset($row); // Giải phóng tham chiếu
    }
    return $res;

  }

  // Phương thức để tạo một bản ghi mới
  public static function create($data) : bool|string
  {
    $params = [];
    $dataKeys = [];

    foreach ($data as $key => $value) {
      $dataKeys[] = $key;
      $params[":$key"] = $value;
    }

    $columns = implode(', ', $dataKeys);
    $placeholders = ':' . implode(', :', $dataKeys);
    $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";

    // dumpVar(['sql' => $sql, 'params' => $params]);

    self::query($sql, $params);
    return self::pdo()->lastInsertId();
  }

  // Phương thức để cập nhật một bản ghi theo ID
  public static function update($conditions, array $data) : bool
  {
    // Xây dựng SET clause, WHERE clause
    $setClauses = self::buildSqlClause($data, 'SET');
    $whereClause = self::buildSqlClause($conditions);

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE " . static::$table . " ";
    $sql .= $setClauses['sql'];
    $sql .= $whereClause['sql'];

    // dumpVar(['sql' => $sql, 'params' => $params]);

    $res = self::query($sql, array_merge($setClauses['bindings'], $whereClause['bindings']));
    return $res !== false;
  }

  // Phương thức để xóa một bản ghi theo ID
  public static function delete($conditions = []) : bool
  {
    $sql = "DELETE FROM " . static::$table . " ";

    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // dumpVar(['sql' => $sql, 'params' => $params]);

    $res = self::query($sql, $whereData['bindings']);
    return $res !== false;
  }

  // Đếm số lượng bản ghi trong bảng, với điều kiện tùy chọn
  public static function count($conditions = [])
  {
    $sql = "SELECT COUNT(*) FROM " . static::$table . " ";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // dumpVar(['sql' => $sql, 'params' => $params]);

    // Trả về kết quả đếm được
    return self::fetchColumn($sql, $whereData['bindings']);
  }


  public static function join($joins, $columns = ['*'], $conditions = [], $orderBy = null, $limit = null, $offset = null, $groupBy = null, $clauseType = 'WHERE')
  {
    $columnString = implode(', ', $columns);
    $sql = "SELECT $columnString FROM " . static::$table . " ";

    // Thêm các JOIN
    foreach ($joins as $join) {
      $sql .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
    }

    // Thêm điều kiện WHERE nếu có
    $whereData = self::buildSqlClause(conditions: $conditions, clauseType: $clauseType);
    $sql .= $whereData['sql'];

    // Thêm GROUP BY nếu có
    if ($groupBy) {
      $sql .= " GROUP BY $groupBy";
    }

    // Thêm ORDER BY nếu có
    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    // Thêm LIMIT nếu có
    $params = $whereData['bindings'];
    if ($limit) {
      $sql .= " LIMIT :limit";
      $params[':limit'] = (int) $limit;
    }

    // Thêm OFFSET nếu có
    if ($offset) {
      $sql .= " OFFSET :offset";
      $params[':offset'] = $offset;
    }

    // dumpVar(['sql' => $sql, 'params' => $params]);

    return self::fetchAll($sql, $params);
  }

  public static function search($keyword = [], $op = 'AND', $conditions=['status' => 'active'], $limit = null)
  {
    if (empty($keyword)) return [];
    $sql = "SELECT * FROM " . static::$table;

    $keywordClause = [];
    $paramsClause = [];
    if (empty($conditions) == false) {
      $conditionsClause = self::buildSqlClause($conditions);
      $sql .= $conditionsClause['sql'] . " AND ";
      $paramsClause = $conditionsClause['bindings'];
    } else {
      $sql .= " WHERE ";
    }

    foreach ($keyword as $key => $value) {
      $keywordClause[] = "$key LIKE :$key";
      $paramsClause[":$key"] = "%$value%";
    }

    $sql .= implode(" $op ", $keywordClause);

    if ($limit) {
      $sql .= " LIMIT :limit";
      $paramsClause[':limit'] = $limit;
    }

    // dumpVar(['sql' => $sql , 'params' => $paramsClause]);

    return self::fetchAll($sql, $paramsClause);
  }

  public static function paginate($page = 1, $perPage = 10, $conditions = [], $data = []) : array
  {
    // Đếm tổng số bản ghi
    $total = self::count($conditions);

    return [
      'data' => $data,
      'total' => $total,
      'per_page' => $perPage,
      'current_page' => $page,
      'last_page' => ceil($total / $perPage),
    ];
  }

  public static function aliasColumns(array $columns, string $table, string $alias, array $overrides = []) : array
  {
    return array_map(
      fn ($column, $key) => isset ($overrides[$key])
      ? $table . ".$key AS {$overrides[$key]}"
      : $table . ".$key AS {$alias}_$column",
      $columns,
      array_values($columns)
    );
  }

  /**
   * Thêm tiền tố bảng vào điều kiện
   */
  public static function prefixConditions(array $conditions, string $table) : array
  {
    return array_combine(
      array_map(fn ($key) => "$table.$key", array_keys($conditions)),
      array_values($conditions));
  }


}
