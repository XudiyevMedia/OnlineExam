<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['question_id'], $_POST['question_title'], $_POST['option_a'], $_POST['option_b'], $_POST['option_c'], $_POST['option_d'], $_POST['correct_answer'], $_POST['question_topic'])) {
        $questionID = $_POST['question_id'];
        $questionTitle = $_POST['question_title'];
        $optionA = $_POST['option_a'];
        $optionB = $_POST['option_b'];
        $optionC = $_POST['option_c'];
        $optionD = $_POST['option_d'];
        $correctAnswer = $_POST['correct_answer'];
		$topicID = $_POST['question_topic'];

        try {
            // Debugging: Print the variables to verify their values
            //var_dump($questionID, $questionTitle, $optionA, $optionB, $optionC, $optionD, $correctAnswer);

            $stmt = $conn->prepare("UPDATE tbl_questions SET 
                question_title = :question_title,
				topic_id = :topic_id,
                option_a = :option_a,
                option_b = :option_b,
                option_c = :option_c,
                option_d = :option_d,
                correct_answer = :correct_answer
                WHERE question_id = :question_id");

            $stmt->bindParam(':question_id', $questionID, PDO::PARAM_INT);
            $stmt->bindParam(':question_title', $questionTitle, PDO::PARAM_STR);
			$stmt->bindParam(':topic_id', $topicID, PDO::PARAM_INT);
            $stmt->bindParam(':option_a', $optionA, PDO::PARAM_STR);
            $stmt->bindParam(':option_b', $optionB, PDO::PARAM_STR);
            $stmt->bindParam(':option_c', $optionC, PDO::PARAM_STR);
            $stmt->bindParam(':option_d', $optionD, PDO::PARAM_STR);
            $stmt->bindParam(':correct_answer', $correctAnswer, PDO::PARAM_STR);

            $stmt->execute();

            echo "
            <script>
                alert('Updated Successfully!');
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
