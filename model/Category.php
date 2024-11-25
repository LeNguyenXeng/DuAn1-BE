<?php
require_once "config/database.php";

class Category {
    private $conn;
    private $table_name = "danh_muc"; // Đổi theo tên bảng của bạn trong file duan1.sql

    public $id;
    public $name;

    public function __construct() {
        $database = new Database();<?php
require_once "config/database.php";

class Category {
    private $conn;
    private $table_name = "danh_muc"; // Đổi theo tên bảng của bạn trong file duan1.sql

    public $id;
    public $name;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createCategory($name) {
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        return $stmt->execute();
    }
}
?>
        $this->conn = $database->getConnection();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createCategory($name) {
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        return $stmt->execute();
    }
}
?>
