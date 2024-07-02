<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['topic_id'], $_POST['topic_name'], $_POST['topic_description'], $_POST['subject_id'])) {
        $topicID = $_POST['topic_id'];
        $topicName = $_POST['topic_name'];
        $topicDescription = $_POST['topic_description'];
        $subjectID = $_POST['subject_id'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_topics SET 
                topic_name = :topic_name,
                topic_description = :topic_description,
                subject_id = :subject_id
                WHERE topic_id = :topic_id");

            $stmt->bindParam(':topic_id', $topicID, PDO::PARAM_INT);
            $stmt->bindParam(':topic_name', $topicName, PDO::PARAM_STR);
            $stmt->bindParam(':topic_description', $topicDescription, PDO::PARAM_STR);
            $stmt->bindParam(':subject_id', $subjectID, PDO::PARAM_INT);

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
