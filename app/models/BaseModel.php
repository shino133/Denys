<?php
class BaseModel
{
  protected static $pdo;
  protected static $table;

  protected static function pdo()
  {
    if (!self::$pdo) {
      // Kết nối tới cơ sở dữ liệu (ví dụ dùng PDO)
      self::$pdo = new PDO(
        dsn: 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        username: DB_USER,
        password: DB_PASSWORD
      );
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return self::$pdo;
  }

  // Truy vấn SQL
  protected static function query($sql, $params = []): bool|PDOStatement
  {
    // dumpVar(['sql' => $sql, 'params' => $params]);
    $stmt = self::pdo()->prepare($sql);
    // Bind các tham số để đảm bảo kiểu dữ liệu đúng
    foreach ($params as $key => $value) {
      $type = match (true) {
        is_int($value) => PDO::PARAM_INT,
        default => PDO::PARAM_STR,
      };

      $stmt->bindValue($key, $value, $type);
    }

    $stmt->execute();
    return $stmt;
  }

  // Xây dựng SQL clause
  protected static function buildSqlClause(array $conditions, $clauseType = 'WHERE'): array
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
  public static function fetchAll($sql, $params = []): array
  {
    return self::query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  // Lấy một bản ghi
  public static function fetchOne($sql, $params = []): mixed
  {
    return self::query($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  public static function fetchColumn($sql, $params = []): array
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
  public static function find($conditions = [], $columns = ['*'], $limit = null, $orderBy = null, $offset = null): array
  {
    $columnsList = implode(', ', $columns);
    $sql = "SELECT $columnsList FROM " . static::$table . " ";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // Thêm LIMIT với OFFSET
    $params = $whereData['bindings'];
    if ($limit) {
      $sql .= " LIMIT " . (int) $limit;
    }

    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    if ($offset) {
      $sql .= " OFFSET " . (int) $offset;
    }

    // dumpVar(['sql' => $sql, 'params' => $params]);
    return self::fetchAll($sql, $params);
  }

  // Phương thức để tạo một bản ghi mới
  public static function create($data): bool|string
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
  public static function update($conditions, array $data): bool
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
  public static function delete($conditions = []): bool
  {
    $sql = "DELETE FROM " . static::$table . " ";

    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // dumpVar(['sql' => $sql, 'params' => $params]);

    $res = self::query($sql, $whereData['bindings']);
    return $res !== false;
  }

  // Đếm số lượng bản ghi trong bảng, với điều kiện tùy chọn
  public static function count($conditions = []): int
  {
    $sql = "SELECT COUNT(*) FROM " . static::$table . " ";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = self::buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // dumpVar(['sql' => $sql, 'params' => $params]);

    // Trả về kết quả đếm được
    return (int) self::fetchColumn($sql, $whereData['bindings']);
  }


  public static function join($joins, $columns = ['*'], $conditions = [], $orderBy = null, $limit = null, $offset = null, $groupBy = null)
  {
    $columnString = implode(', ', $columns);
    $sql = "SELECT $columnString FROM " . static::$table . " ";

    // Thêm các JOIN
    foreach ($joins as $join) {
      $sql .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
    }

    // Thêm điều kiện WHERE nếu có
    $whereData = self::buildSqlClause($conditions);
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
      $params[':limit'] = $limit;
    }

    // Thêm OFFSET nếu có
    if ($offset) {
      $sql .= " OFFSET :offset";
      $params[':offset'] = $offset;
    }

    // dumpVar(['sql' => $sql, 'params' => $params]);

    return self::fetchAll($sql, $params);
  }
}
