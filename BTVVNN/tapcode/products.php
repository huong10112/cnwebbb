<?php
// Bắt đầu session
session_start();

// Kiểm tra danh sách sản phẩm trong session
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    die('Không tìm thấy danh sách sản phẩm trong session!');
}

$products = $_SESSION['products'];

// Kiểm tra tham số ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID sản phẩm không hợp lệ hoặc không tồn tại!');
}

$id = (int)$_GET['id'];
if (!isset($products[$id])) {
    die('Không tìm thấy sản phẩm với ID này!');
}

$product = $products[$id]; // Lấy sản phẩm từ danh sách
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Chi tiết sản phẩm</h1>
    <p><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['name']) ?></p>
    <p><strong>Giá sản phẩm:</strong> <?= htmlspecialchars($product['price']) ?> VNĐ</p>
    <a href="index.php" class="btn btn-secondary">Quay lại</a>
</div>
</body>
</html>
