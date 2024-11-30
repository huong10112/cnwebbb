<?php
// Đọc tệp câu hỏi từ file cauhoi.txt
$filename = "cauhoi.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$current_question = [];
$all_questions = [];
$question_number = 1;

// Xử lý câu hỏi và đáp án
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            // Lưu câu hỏi và đáp án vào mảng
            $all_questions[] = $current_question;
        }
        $current_question = []; // Bắt đầu câu hỏi mới
        $current_question[] = $line; // Lưu câu hỏi
    } else {
        $current_question[] = $line; // Lưu đáp án
    }
}
if (!empty($current_question)) {
    $all_questions[] = $current_question; // Lưu câu hỏi cuối cùng
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài kiểm tra trắc nghiệm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Chào mừng bạn đến với bài kiểm tra trắc nghiệm!</h2>

        <form action="submit.php" method="POST">
            <?php
            foreach ($all_questions as $index => $question) {
                echo "<div class='card mb-4'>";
                echo "<div class='card-header'><strong>" . $question[0] . "</strong></div>";
                echo "<div class='card-body'>";
                
                for ($i = 1; $i <= 4; $i++) {
                    $answer = substr($question[$i], 0, 1); // A, B, C, D
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='question" . ($index + 1) . "' value='" . $answer . "' id='question" . ($index + 1) . $answer . "'>";
                    echo "<label class='form-check-label' for='question" . ($index + 1) . $answer . "'>" . $question[$i] . "</label>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</div>";
            }
            ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
