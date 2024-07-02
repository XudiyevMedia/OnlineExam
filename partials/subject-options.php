<?php
// Include your database connection file
include_once("../conn/conn.php");

// Fetch subjects from tbl_subjects
$stmt = $conn->prepare('SELECT * FROM `tbl_subjects`');
$stmt->execute();
$subjects = $stmt->fetchAll();

// Output options for select dropdown
foreach ($subjects as $subject) {
    $subjectID = $subject['subject_id'];
    $subjectName = $subject['subject_name'];
    echo "<option value='$subjectID'>$subjectName</option>";
}
?>
