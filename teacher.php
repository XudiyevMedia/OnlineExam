<?php
include ('./partials/header.php');
include ('./conn/conn.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.php');
    exit;
}
include ('./partials/modal.php');
?>

<div class="main">
<?php
include("./partials/nav-tea.php");
?>

    <div id="pills-home">
        <h2 id="welcome-teacher">Welcome Teacher!</h2>
        <small>This is a teacher area where you can add quizzes and see the results.</small>
    </div>

    </div>
</div>


<?php include ('./partials/footer.php') ?>