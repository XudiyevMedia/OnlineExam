<!-- login.php -->
<?php
include ('./partials/header.php');
include ('./conn/conn.php');
session_start();
?>
<div class="main">
<div class="quiz-container">
<div class="quiz">
    <h2>Login</h2>
    <form action="admin.php" method="POST">
        <div class="form-group">
            <label for="username">Adminname:</label>
            <input type="text" class="form-control" id="adminname" name="adminname" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM tbl_admin WHERE adminname = ?');
    $stmt->execute([$adminname]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['admin_id'];
        $_SESSION['adminname'] = $user['adminname'];
        header('Location: quiz.php');
        exit;
    } else {
        echo '<div class="alert alert-danger" style="margin-top:1rem">Invalid username or password.</div>';
    }
}
?>
</div>
</div>
</div>
<?php include ('./partials/footer.php') ?>
