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

  // Phương thức để lấy tất cả các bản ghi từ bảng
  public function getAll()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Phương thức để tìm bản ghi theo ID
  public function find($id, $columns = ['*'])
  {
    // Xây dựng danh sách cột cần lấy, mặc định là '*'
    $columnList = implode(', ', $columns);

    // Chuẩn bị câu truy vấn với các cột được chỉ định
    $stmt = $this->pdo->prepare("SELECT {$columnList} FROM {$this->table} WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Phương thức để tạo một bản ghi mới
  public function create($data)
  {
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");

    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  // Phương thức để cập nhật một bản ghi theo ID
  public function update($id, $data)
  {
    $setClause = '';
    foreach ($data as $key => $value) {
      $setClause .= "$key = :$key, ";
    }
    $setClause = rtrim($setClause, ', ');

    $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $setClause WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  // Phương thức để xóa một bản ghi theo ID
  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  // Đếm số lượng bản ghi trong bảng, với điều kiện tùy chọn
  public function count($conditions = [])
  {
    $query = "SELECT COUNT(*) as count FROM {$this->table}";

    if (!empty($conditions)) {
      $whereClauses = [];
      foreach ($conditions as $key => $value) {
        $whereClauses[] = "$key = :$key";
      }
      $query .= ' WHERE ' . implode(' AND ', $whereClauses);
    }

    $stmt = $this->pdo->prepare($query);

    foreach ($conditions as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
  }

  // Tìm bản ghi theo điều kiện
  public function findByCondition($conditions = [], $limit = null, $offset = null): array
  {
    $query = "SELECT * FROM {$this->table}";

    if (!empty($conditions)) {
      $whereClauses = [];
      foreach ($conditions as $key => $value) {
        $whereClauses[] = "$key = :$key";
      }
      $query .= ' WHERE ' . implode(' AND ', $whereClauses);
    }

    if ($limit !== null) {
      $query .= " LIMIT :limit";
    }
    if ($offset !== null) {
      $query .= " OFFSET :offset";
    }

    $stmt = $this->pdo->prepare($query);

    foreach ($conditions as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    if ($limit !== null) {
      $stmt->bindValue(":limit", (int) $limit, PDO::PARAM_INT);
    }
    if ($offset !== null) {
      $stmt->bindValue(":offset", (int) $offset, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
