<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['exam_id'], $_POST['exam_name'], $_POST['exam_description'], $_POST['start_date'], $_POST['end_date'])) {
        $examID = $_POST['exam_id'];
        $examName = $_POST['exam_name'];
        $examDescription = $_POST['exam_description'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_exams SET 
                exam_name = :exam_name,
                exam_description = :exam_description,
                start_date = :start_date,
                end_date = :end_date
                WHERE exam_id = :exam_id");

            $stmt->bindParam(':exam_id', $examID, PDO::PARAM_INT);
            $stmt->bindParam(':exam_name', $examName);
            $stmt->bindParam(':exam_description', $examDescription);
            $stmt->bindParam(':start_date', $startDate);
            $stmt->bindParam(':end_date', $endDate);

            $stmt->execute();

            echo "
            <script>
                alert('Exam Updated Successfully!');
                window.location.href = 'http://localhost/OQS/quiz.php';
            </script>
            ";
            exit();
        } catch (PDOException $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
            alert('Please fill in all the required fields.');
            window.location.href = 'http://localhost/OQS/quiz.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('Invalid request method.');
        window.location.href = 'http://localhost/OQS/quiz.php';
    </script>
    ";
}
?>
