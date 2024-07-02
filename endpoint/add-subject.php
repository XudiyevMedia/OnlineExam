<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subject_name'], $_POST['subject_description'])) {
        $subjectName = $_POST['subject_name'];
        $subjectDescription = $_POST['subject_description'];

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_subjects (subject_name, subject_description) VALUES (:subject_name, :subject_description)");

            $stmt->bindParam(':subject_name', $subjectName);
            $stmt->bindParam(':subject_description', $subjectDescription);

            $stmt->execute();

            echo "
            <script>
                alert('Added Successfully!');
                window.location.href = 'http://localhost/OQS/subjects.php';
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
            window.location.href = 'http://localhost/OQS/subjects.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('Invalid request method.');
        window.location.href = 'http://localhost/OQS/subjects.php';
    </script>
    ";
}
?>
