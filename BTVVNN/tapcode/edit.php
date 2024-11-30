<?php
// Bắt đầu session
if (!session_id()) {
    session_start();
}

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

// Xử lý cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $price = htmlspecialchars($_POST['price'] ?? '');

    // Kiểm tra dữ liệu đầu vào
    if ($name && is_numeric($price) && $price > 0) {
        $products[$id] = ['name' => $name, 'price' => $price]; // Cập nhật sản phẩm
        $_SESSION['products'] = $products; // Lưu lại vào session
        header('Location: index.php'); // Quay lại trang chính
        exit;
    } else {
        echo 'Vui lòng nhập đầy đủ thông tin và đảm bảo giá hợp lệ!';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Chỉnh sửa sản phẩm</h1>
    <form action="edit.php?id=<?= $id ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="text" name="price" id="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
