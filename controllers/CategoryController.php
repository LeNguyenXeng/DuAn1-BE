<?php
require_once "model/Category.php";

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function index() {
        $categories = $this->category->getAllCategories();
        include "view/home.php";
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST['name'];
            if ($this->category->createCategory($name)) {
                echo "Thêm danh mục thành công!";
            } else {
                echo "Lỗi khi thêm danh mục!";
            }
        }
        include "view/create.php";
    }
}
?>