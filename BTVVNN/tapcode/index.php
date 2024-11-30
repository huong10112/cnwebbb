<?php
// Bắt đầu session
session_start();

// Kiểm tra danh sách sản phẩm trong session
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Danh sách sản phẩm</h1>
    <a href="add.php" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <?php if (count($products) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $id => $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?> VNĐ</td>
                        <td>
                            <a href="edit.php?id=<?= $id ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Chưa có sản phẩm nào trong danh sách.</p>
    <?php endif; ?>
</div>
</body>
</html>
