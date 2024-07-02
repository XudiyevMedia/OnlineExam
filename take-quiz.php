<!-- take-exam.php -->
<?php
include ('./partials/header.php');
include ('./conn/conn.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include ('./partials/modal.php');
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
            $stmt = $conn->prepare('SELECT * FROM `tbl_questions`');
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $row) {
                $quizID = $row['question_id'];
                $quizQuestion = $row['question_title'];
                $optionA = $row['option_a'];
                $optionB = $row['option_b'];
                $optionC = $row['option_c'];
                $optionD = $row['option_d'];
                $correctAnswer = $row['correct_answer'];
            ?>
            <div class="question">
                <p><?= $quizID ?>. <?= $quizQuestion ?></p>
                <ol class="choices">
                    <li>
                        <input type="radio" id="question<?= $quizID ?>-a" name="question<?= $quizID ?>" value="A">
                        <label for="question<?= $quizID ?>-a"><?= $optionA ?></label>
                    </li>
                    <li>
                        <input type="radio" id="question<?= $quizID ?>-b" name="question<?= $quizID ?>" value="B">
                        <label for="question<?= $quizID ?>-b"><?= $optionB ?></label>
                    </li>
                    <li>
                        <input type="radio" id="question<?= $quizID ?>-c" name="question<?= $quizID ?>" value="C">
                        <label for="question<?= $quizID ?>-c"><?= $optionC ?></label>
                    </li>
                    <li>
                        <input type="radio" id="question<?= $quizID ?>-d" name="question<?= $quizID ?>" value="D">
                        <label for="question<?= $quizID ?>-d"><?= $optionD ?></label>
                    </li>
                </ol>
            </div>
            <?php
            }
            ?>
        </div>
        <button type="button" class="btn btn-secondary" id="submitAnswer">Submit <i class="fa-sharp fa-solid fa-share"></i></button>
    </div>

    </div>

    </div>
</div>

<?php
$stmt = $conn->prepare('SELECT * FROM `tbl_questions`');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<script>';
echo 'var quizData = ' . json_encode($result) . ';';
echo '</script>';
?>

<script>
    document.getElementById("submitAnswer").addEventListener("click", function() {
        var questions = document.querySelectorAll(".question");
        var correctAnswers = 0;

        questions.forEach(function(question, index) {
            var selectedOption = question.querySelector('input[type="radio"]:checked');
            if (selectedOption) {
                var userAnswer = selectedOption.value;
                var correctAnswer = quizData[index].correct_answer;

                if (userAnswer === correctAnswer) {
                    correctAnswers++;
                    question.classList.add("correct");
                }
            }
        });

        $("#resultModal").modal("show");

        $("#totalScore").val(correctAnswers);
    });
</script>

<?php include ('./partials/footer.php') ?>
