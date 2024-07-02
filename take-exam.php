<!-- take-exam.php -->
<?php
include ('./partials/header.php');
include ('./conn/conn.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
            $stmt = $conn->prepare('SELECT * FROM `tbl_questions`');
            $stmt->execute();
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
            <!-- <div class="question" id="question-<?= $index ?>" style="display: <?= $index === 0 ? 'block' : 'none' ?>;">
                <div class="row">
                    <div class="col-md-8">
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
                    </div> -->
					

			<div class="question" id="question-<?= $index ?>" style="display: <?= $index === 0 ? 'block' : 'none' ?>;>
			  <div class="row">
				<div class="title"> <?= $questionID ?>. <?= $questionTitle ?> 
				    <?php if (!empty($imageURL)) { ?>
                    <div class="col-md-4">
                        <img src="img/<?= $imageURL ?>" alt="Question Image" class="img-fluid">
                    </div>
                    <?php } ?>
				</div>
				<div class="content">
					    <input type="radio" name="question<?= $questionID ?>" id="question<?= $questionID ?>-a" value="A">
						<input type="radio" name="question<?= $questionID ?>" id="question<?= $questionID ?>-b" value="B">
						<input type="radio" name="question<?= $questionID ?>" id="question<?= $questionID ?>-c" value="C">
						<input type="radio" name="question<?= $questionID ?>" id="question<?= $questionID ?>-d" value="D">
						<div class="Parent" id="parent1">
							<div class="child1">
								<label for="question<?= $questionID ?>-a" class="box first">
									<!-- Horizontal line above the next question -->
									<div class="horizontal-line" id="h<?= $questionID ?>-1" style="display: none;"></div>
									<div class="plan">
									  <span class="circle"> A </span>
									  <span class="yearly"><?= $optionA ?></span>
									</div>
								</label>
							</div>
  
						<div class="child2">
							<span class="price" id="b<?= $questionID ?>-1" onclick="toggle(this)"><img class="icon" src="img/Ap.png" width="36"></span> 
						</div>
						</div>	
						<div class="Parent" id="parent2">
							<div class="child1">
								<label for="question<?= $questionID ?>-b" class="box second">
									<!-- Horizontal line above the next question -->
									<div class="horizontal-line" id="h<?= $questionID ?>-2" style="display: none;"></div>
									<div class="plan">
									  <span class="circle"> B </span>
									  <span class="yearly"><?= $optionB ?></span>
									</div>
								</label>
							</div>


						<div class="child2">
							<span class="price" id="b<?= $questionID ?>-2" onclick="toggle(this)"><img class="icon" src="img/Bp.png" width="36"></span>
						</div> 
						</div>	
						<div class="Parent" id="parent3">
							<div class="child1">
								<label for="question<?= $questionID ?>-c" class="box third">
									<!-- Horizontal line above the next question -->
									<div class="horizontal-line" id="h<?= $questionID ?>-3" style="display: none;"></div>
									<div class="plan">
									  <span class="circle"> C </span>
									  <span class="yearly"><?= $optionC ?></span>
									</div>
								</label>
							</div>
						  
						<div class="child2">	
							<span class="price" id="b<?= $questionID ?>-3" onclick="toggle(this)"><img class="icon" src="img/Cp.png" width="36"></span>
						</div>
						</div>	
						<div class="Parent" id="parent4">
							<div class="child1">
								<label for="question<?= $questionID ?>-d" class="box fourth">
									<!-- Horizontal line above the next question -->
									<div class="horizontal-line" id="h<?= $questionID ?>-4" style="display: none;"></div>
									<div class="plan">
									  <span class="circle">D</span>
									  <span class="yearly"><?= $optionD ?></span>
									</div>
								</label>
							</div>
						
						<div class="child2">	
							<span class="price" id="b<?= $questionID ?>-4" onclick="toggle(this)"><img class="icon" src="img/Dp.png" width="36"></span>
						</div>
						</div>	


                </div>
                <div class="navigation-buttons">
                    <?php if ($index > 0) { ?>
                        <button type="button" class="btn btn-primary prev-btn">Previous</button>
                    <?php } ?>
                    <?php if ($index < count($result) - 1) { ?>
                        <button type="button" class="btn btn-primary next-btn">Next</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-secondary float-right" id="submitAnswer">Finalize <i class="fa-sharp fa-solid fa-share"></i></button>
                    <?php } ?>
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

<?php
$stmt = $conn->prepare('SELECT * FROM `tbl_questions`');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<script>';
echo 'var quizData = ' . json_encode($result) . ';';
echo '</script>';
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentQuestionIndex = 0;
        var questions = document.querySelectorAll(".question");

        function showQuestion(index) {
            questions.forEach(function(question, i) {
                question.style.display = i === index ? 'block' : 'none';
            });
        }

        document.querySelectorAll(".next-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    showQuestion(currentQuestionIndex);
                }
            });
        });

        document.querySelectorAll(".prev-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    showQuestion(currentQuestionIndex);
                }
            });
        });

        document.getElementById("submitAnswer").addEventListener("click", function() {
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

            //$("#resultModal").modal("show");

            $("#totalScore").val(correctAnswers);
        });

        showQuestion(currentQuestionIndex);
    });
</script>



<?php include ('./partials/footer.php') ?>
