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

    <div id="pills-home">
        <h2 id="welcome-teacher">Welcome Student!</h2>
        <small>This is a student area where you can take quizzes, and the result will be sent to the teacher <br> area after you have submitted.</small>
        <br>
        <button id="takeQuiz">
            <a class="nav-link" href="./take-quiz.php" style="color: inherit">Take Quiz <i class="fa-solid fa-arrow-right"></i></a>
        </button>
        <button id="takeQuiz">
            <a class="nav-link" href="./take-exam.php" style="color: inherit">Take Exam<i class="fa-solid fa-arrow-right"></i></a>
        </button>
    </div>

    </div>
</div>


<?php include ('./partials/footer.php') ?>