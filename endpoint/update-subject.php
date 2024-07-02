<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subject_id'], $_POST['subject_name'], $_POST['subject_description'])) {
        $subjectID = $_POST['subject_id'];
        $subjectName = $_POST['subject_name'];
        $subjectDescription = $_POST['subject_description'];

        try {
            // Debugging: Print the variables to verify their values
            // var_dump($subjectID, $subjectName, $subjectDescription);

            $stmt = $conn->prepare("UPDATE tbl_subjects SET 
                subject_name = :subject_name,
                subject_description = :subject_description
                WHERE subject_id = :subject_id");

            $stmt->bindParam(':subject_id', $subjectID, PDO::PARAM_INT);
            $stmt->bindParam(':subject_name', $subjectName, PDO::PARAM_STR);
            $stmt->bindParam(':subject_description', $subjectDescription, PDO::PARAM_STR);

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
