<?php
// Đọc tệp câu hỏi và đáp án từ file cauhoi.txt
$filename = "cauhoi.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$answers = [];
$current_question = [];
$all_answers = [];

// Lưu đáp án vào mảng
foreach ($questions as $line) {
    if (strpos($line, "Đáp án:") !== false) {
        $answers[] = trim(substr($line, strpos($line, ":") + 1));
    }
}

$score = 0;

// Kiểm tra câu trả lời của người dùng
foreach ($_POST as $key => $userAnswer) {
    // Lọc số câu hỏi từ tên biến (ví dụ: 'question1' => 1)
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    
    // So sánh đáp án của người dùng với đáp án đúng
    if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài kiểm tra</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h3>Bạn đã trả lời đúng <strong><?php echo $score; ?></strong> trên tổng số <?php echo count($answers); ?> câu.</h3>
        </div>
        <a href="index.php" class="btn btn-primary">Làm lại</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
