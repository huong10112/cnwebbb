<?php
// Bắt đầu session
if (!session_id()) {
    session_start();
}

// Kiểm tra danh sách sản phẩm trong session
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Biến thông báo lỗi
$error_message = '';

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');  // Lấy tên sản phẩm
    $price = htmlspecialchars($_POST['price'] ?? ''); // Lấy giá sản phẩm
    
    // Kiểm tra tên sản phẩm và giá có hợp lệ hay không
    if (!$name || !$price) {
        $error_message = 'Vui lòng nhập đầy đủ thông tin!'; // Thông báo lỗi nếu thiếu thông tin
    } elseif (!is_numeric($price) || $price <= 0) {
        $error_message = 'Giá sản phẩm phải là một số dương!'; // Thông báo lỗi nếu giá không hợp lệ
    } else {
        // Thêm sản phẩm vào session nếu không có lỗi
        $_SESSION['products'][] = ['name' => $name, 'price' => $price];
        // Sau khi thêm, chuyển hướng người dùng về trang danh sách sản phẩm (index.php)
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Thêm sản phẩm mới</h1>
    
    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= $error_message ?>
        </div>
    <?php endif; ?>

    <form action="add.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
