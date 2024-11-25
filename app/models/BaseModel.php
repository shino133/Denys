<?php
class BaseModel
{
  protected $pdo;
  protected $table;

  public function __construct()
  {
    // Kết nối tới cơ sở dữ liệu (ví dụ dùng PDO)
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  // Truy vấn SQL
  protected function query($sql, $params = []): bool|PDOStatement
  {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  // Xây dựng SQL clause
  protected function buildSqlClause(array $conditions, $clauseType = 'WHERE'): array
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
      $placeholder = ":$column" . "_$clauseType";
      $clauses[] = "$column = $placeholder ";
      $bindings[$placeholder] = $value;
    }
    
    $sql = " $clauseType " . implode(" $connector ", $clauses);
    
    return ['sql' => $sql, 'bindings' => $bindings];
  }

  // Lấy tất cả bản ghi
  public function fetchAll($sql, $params = []): array
  {
    return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  // Lấy một bản ghi
  public function fetchOne($sql, $params = []): mixed
  {
    return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchColumn($sql, $params = []): array
  {
    return $this->query($sql, $params)->fetchColumn();
  }

  // Lấy tất cả dữ liệu từ bảng hiện tại
  public function read($columns = ['*'], $orderBy = null, $limit = null)
  {
    $columnString = implode(', ', $columns);
    $sql = "SELECT $columnString FROM {$this->table}";

    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    $params = [];
    if ($limit) {
      $sql .= " LIMIT :limit";
      $params[':limit'] = $limit;
    }

    return $this->fetchAll($sql, $params);
  }

  // Phương thức để tìm bản ghi theo điều kiện
  public function find($conditions = [], $columns = ['*'], $limit = null, $offset = null)
  {
    $columnsList = implode(', ', $columns);
    $sql = "SELECT $columnsList FROM {$this->table}";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = $this->buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // Thêm LIMIT với OFFSET
    $params = $whereData['bindings'];
    if ($limit) {
      $sql .= " LIMIT " . (int) $limit;
    }

    if ($offset) {
      $sql .= " OFFSET " . (int) $offset;
    }

    // dumpVar(['sql' => $sql, 'params' => $params]);
    return $this->fetchAll($sql, $params);
  }

  // Phương thức để tạo một bản ghi mới
  public function create($data): bool|string
  {
    $params = [];
    $dataKeys = [];

    foreach ($data as $key => $value) {
      $dataKeys[] = $key;
      $params[":$key"] = $value;
    }

    $columns = implode(', ', $dataKeys);
    $placeholders = ':' . implode(', :', $dataKeys);
    $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

    $this->query($sql, $params);
    return $this->pdo->lastInsertId();
  }

  // Phương thức để cập nhật một bản ghi theo ID
  public function update($conditions, array $data)
  {
    // Xây dựng SET clause, WHERE clause
    $setClauses = $this->buildSqlClause($data, 'SET');
    $whereClause = $this->buildSqlClause($conditions);

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE {$this->table}";
    $sql .= $setClauses['sql'];
    $sql .= $whereClause['sql'];

    $res = $this->query($sql, array_merge($setClauses['bindings'], $whereClause['bindings']));
    return $res !== false;
  }

  // Phương thức để xóa một bản ghi theo ID
  public function delete($conditions = [])
  {
    $sql = "DELETE FROM {$this->table}";

    $whereData = $this->buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    $res = $this->query($sql, $whereData['bindings']);
    return $res !== false;
  }

  // Đếm số lượng bản ghi trong bảng, với điều kiện tùy chọn
  public function count($conditions = []): int
  {
    $sql = "SELECT COUNT(*) FROM {$this->table}";

    // Gọi hàm buildClause để thêm điều kiện WHERE
    $whereData = $this->buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // Trả về kết quả đếm được
    return (int) $this->fetchColumn($sql, $whereData['bindings']);
  }


  // Phương thức join bảng, cơ sở dữ liệu, điều kiện where, sắp xếp, với limit
  public function join($joins, $columns = ['*'], $conditions = [], $orderBy = null, $limit = null)
  {
    $columnString = implode(', ', $columns);
    $sql = "SELECT $columnString FROM {$this->table}";

    // Thêm các JOIN
    foreach ($joins as $join) {
      $sql .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
    }

    // Thêm điều kiện WHERE nếu có
    $whereData = $this->buildSqlClause($conditions);
    $sql .= $whereData['sql'];

    // Thêm ORDER BY nếu có
    if ($orderBy) {
      $sql .= " ORDER BY $orderBy";
    }

    // Thêm LIMIT nếu có
    $params = [];
    if ($limit) {
      $sql .= " LIMIT :limit";
      $params[':limit'] = $limit;
    }

    return $this->fetchAll($sql, array_merge($whereData['bindings'], $params));
  }
}
