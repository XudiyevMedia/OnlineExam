<?php
session_start();
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['year_section'], $_POST['total_score'])) {
        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $quizTaker = $_SESSION['username']; // Get the quiz taker from the session
            $yearSection = $_POST['year_section'];
            $totalScore = $_POST['total_score'];
            $dateTaken = date("Y-m-d H:i:s"); 

            try {
                $stmt = $conn->prepare("INSERT INTO tbl_result (quiz_taker, year_section, total_score, date_taken) VALUES (:quiz_taker, :year_section, :total_score, :date_taken)");

                $stmt->bindParam(':quiz_taker', $quizTaker);
                $stmt->bindParam(':year_section', $yearSection);
                $stmt->bindParam(':total_score', $totalScore);
                $stmt->bindParam(':date_taken', $dateTaken);

                $stmt->execute();

                echo "
                <script>
                    alert('Submitted Successfully!');
                    window.location.href = 'http://localhost/OQS/student.php';
                </script>
                ";
                exit();
            } catch (PDOException $e) {
                echo 'Database Error: ' . $e->getMessage();
            }
        } else {
            echo "
            <script>
                alert('You must be logged in to submit a quiz.');
                window.location.href = 'http://localhost/OQS/login.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Please fill in all required fields.');
            window.location.href = 'http://localhost/OQS/take-quiz.php';
        </script>
        ";
    }
}
?>
