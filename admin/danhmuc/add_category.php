
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $sql = "INSERT INTO danh_muc (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: listdm.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555555;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm danh mục</h1>
        <form method="POST">
            <label for="name">Tên danh mục:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>
