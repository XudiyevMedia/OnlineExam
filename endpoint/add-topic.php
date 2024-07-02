<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['topic_name'], $_POST['topic_description'], $_POST['subject_id'])) {
        $topicName = $_POST['topic_name'];
        $topicDescription = $_POST['topic_description'];
        $subjectID = $_POST['subject_id'];

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_topics (topic_name, topic_description, subject_id) VALUES (:topic_name, :topic_description, :subject_id)");

            $stmt->bindParam(':topic_name', $topicName);
            $stmt->bindParam(':topic_description', $topicDescription);
            $stmt->bindParam(':subject_id', $subjectID);

            $stmt->execute();

            echo "
            <script>
                alert('Added Successfully!');
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
