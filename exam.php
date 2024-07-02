<!-- take-exam.php -->
<?php
include ('./partials/header.php');
include ('./conn/conn.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.php');
    exit;
}

//include ('./partials/modal.php');
?>


<div class="main">
<?php
include("./partials/nav-stu.php");
?>
    <div class="take-quiz-area">
        <h3 class="mt-4">Multiple Choice!</h3>
        <small>Select the correct answer from the options provided.</small>
        <div class="questions">
            <?php
			$examid=$_GET['id']; 
            $stmt = $conn->prepare('SELECT tbl_questions.* FROM tbl_exam_questions Inner Join tbl_questions ON tbl_exam_questions.question_id = tbl_questions.question_id Inner Join tbl_exams ON tbl_exams.exam_id = tbl_exam_questions.exam_id WHERE tbl_exams.exam_id =?');
            $stmt->execute([$examid]);
            $result = $stmt->fetchAll();

            foreach ($result as $index => $row) {
                $questionID = $row['question_id'];
                $questionTitle = $row['question_title'];
                $optionA = $row['option_a'];
                $optionB = $row['option_b'];
                $optionC = $row['option_c'];
                $optionD = $row['option_d'];
                $imageURL = $row['image_url'];
                $correctAnswer = $row['correct_answer'];
            ?>
            <div class="question" id="question-<?= $index ?>" >
                <div class="row">
                    <div class="col-md-12">
                        <p><?= $questionID ?>. <?= $questionTitle ?></p>
                        <ol class="choices">
                            <li>
                                <input type="radio" id="question<?= $questionID ?>-a" name="question<?= $questionID ?>" value="A">
                                <label for="question<?= $questionID ?>-a"><?= $optionA ?></label>
                            </li>
                            <li>
                                <input type="radio" id="question<?= $questionID ?>-b" name="question<?= $questionID ?>" value="B">
                                <label for="question<?= $questionID ?>-b"><?= $optionB ?></label>
                            </li>
                            <li>
                                <input type="radio" id="question<?= $questionID ?>-c" name="question<?= $questionID ?>" value="C">
                                <label for="question<?= $questionID ?>-c"><?= $optionC ?></label>
                            </li>
                            <li>
                                <input type="radio" id="question<?= $questionID ?>-d" name="question<?= $questionID ?>" value="D">
                                <label for="question<?= $questionID ?>-d"><?= $optionD ?></label>
                            </li>
                        </ol>
                    </div>
				</div>					
			</div>
            <?php
            }
            ?>
				<form action="./endpoint/add-result.php" method="POST">
					<div class="modal-footer">
                        <input type="hidden" class="form-control" id="quizTaker" name="quiz_taker">
                        <input type="hidden" class="form-control" id="yearSection" name="year_section">
                        <input type="hidden" class="form-control" id="totalScore" name="total_score">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<?php include ('./partials/footer.php') ?>
