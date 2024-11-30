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

// Xóa sản phẩm
unset($products[$id]);

// Cập nhật lại danh sách sản phẩm trong session
$_SESSION['products'] = array_values($products);

// Quay lại trang chính
header('Location: index.php');
exit;
?>
