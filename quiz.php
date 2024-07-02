<?php
include ('./partials/header.php');
include ('./conn/conn.php');
include ('./partials/modal.php');
?>

<div class="main">
<?php
include("./partials/nav-tea.php");
?>


    <div class="quiz-container">

        <div class="quiz">

        <nav class="mt-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
			<button class="nav-link active" id="nav-subjects-tab" data-toggle="tab" data-target="#nav-subjects" type="button" role="tab" aria-controls="nav-subjects" aria-selected="true">Subjects</button>
			<button class="nav-link" id="nav-topics-tab" data-toggle="tab" data-target="#nav-topics" type="button" role="tab" aria-controls="nav-topics" aria-selected="true">Topics</button>
            <button class="nav-link" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Questions</button>
			<button class="nav-link" id="nav-exams-tab" data-toggle="tab" data-target="#nav-exams" type="button" role="tab" aria-controls="nav-exams" aria-selected="true">Exams</button>
            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Result</button>
            </div>

        </nav>

        <div class="tab-content" id="nav-tabContent">
		<!---Subjects--->
			<div class="tab-pane fade show active" id="nav-subjects" role="tabpanel" aria-labelledby="nav-subjects-tab">
				<button type="button" class="btn btn-dark m-2 float-left" id="add-quiz-button" data-toggle="modal" data-target="#addSubjectModal">
								Add Subject
								</button>


							<div class="table-area">
								<table class="table" style="color: white;">
									<thead>
										<tr>
										<th scope="col">Subject ID</th>
										<th scope="col">Subject</th>
										<th scope="col">Description</th>
										<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$stmt = $conn->prepare('SELECT * FROM `tbl_subjects`');
										$stmt->execute();
										$result = $stmt->fetchAll();

										foreach ($result as $row) { 
											$subjectID = $row['subject_id'];
											$subjectName = $row['subject_name'];
											$subjectDescription = $row['subject_description'];
											?>

											<tr>
												<th id="subjectID-<?= $subjectID ?>"><?= $subjectID ?></th>
												<td id="subjectName-<?= $subjectID ?>"><?= $subjectName ?></td>
												<td id="subjectDescription-<?= $subjectID ?>"><?= $subjectDescription ?></td>
												<td>
													<button type="button" class="btn btn-secondary" onclick="updateSubject(<?= $subjectID ?>)"><i class="fa-solid fa-pencil"></i></button>
													<button type="button" class="btn btn-danger" onclick="deleteSubject(<?= $subjectID ?>)"><i class="fa-solid fa-trash"></i></button>
												</td>
											</tr>

											<?php
										}
										?>

									</tbody>
								</table>


							</div>
							
						</div>
				<!---End Subjects--->		
				<!---Topics--->
				<div class="tab-pane fade" id="nav-topics" role="tabpanel" aria-labelledby="nav-topics-tab">
					<button type="button" class="btn btn-dark m-2 float-left" id="add-quiz-button" data-toggle="modal" data-target="#addTopicModal">
						Add Topic
					</button>

					<div class="table-area">
						<table class="table" style="color: white;">
							<thead>
								<tr>
									<th scope="col">Topic ID</th>
									<th scope="col">Subject</th>
									<th scope="col">Topic Name</th>
									<th scope="col">Topic Description</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								// Prepare SQL query to fetch topics with related subject names
								$stmt = $conn->prepare('SELECT t.topic_id, t.topic_name, t.topic_description, s.subject_name 
													   FROM `tbl_topics` AS t 
													   INNER JOIN `tbl_subjects` AS s ON t.subject_id = s.subject_id');
								$stmt->execute();
								$result = $stmt->fetchAll();

								foreach ($result as $row) { 
									$topicID = $row['topic_id'];
									$subjectName = $row['subject_name'];
									$topicName = $row['topic_name'];
									$topicDescription = $row['topic_description'];
									?>

									<tr>
										<th id="topicID-<?= $topicID ?>"><?= $topicID ?></th>
										<td id="topicSubjectName-<?= $topicID ?>"><?= $subjectName ?></td>
										<td id="topicName-<?= $topicID ?>"><?= $topicName ?></td>
										<td id="topicDescription-<?= $topicID ?>"><?= $topicDescription ?></td>
										<td>
											<button type="button" class="btn btn-secondary" onclick="updateTopic(<?= $topicID ?>)"><i class="fa-solid fa-pencil"></i></button>
											<button type="button" class="btn btn-danger" onclick="deleteTopic(<?= $topicID ?>)"><i class="fa-solid fa-trash"></i></button>
										</td>
									</tr>

									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!---End Topics--->
				<!---Questions--->
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <button type="button" class="btn btn-dark m-2 float-left" id="add-quiz-button" data-toggle="modal" data-target="#addQuestionModal">
                    Add Question
                    </button>
                <div class="table-area">
                    <table class="table" style="color: white;">
                        <thead>
                            <tr>
                            <th scope="col">Question ID</th>
							<th scope="col">Topic</th>
                            <th scope="col">Question</th>
                            <th scope="col">Correct Answer (Letter)</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            $stmt = $conn->prepare('SELECT t.topic_name, s.* FROM tbl_topics AS t Inner Join tbl_questions AS s ON t.topic_id = s.topic_id');
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach ($result as $row) { 
                                $questionID = $row['question_id'];
								$questionTopicName=$row['topic_name'];
                                $questionTitle = $row['question_title'];
                                $optionA = $row['option_a'];
                                $optionB = $row['option_b'];
                                $optionC = $row['option_c'];
                                $optionD = $row['option_d'];
                                $correctAnswer = $row['correct_answer'];
                                ?>

                                <tr>
                                    <th id="questionID-<?= $questionID ?>"><?= $questionID ?></th>
									<td id="questionTopicName-<?= $questionID ?>"><?= $questionTopicName ?></td>
									<input id="questionTitle-<?= $questionID ?>" type="hidden" value="<?= $questionTitle ?>"></input>
                                    <td id="questionTitlez-<?= $questionID ?>"><?= substr($questionTitle, 0, 50)."..." ?></td>
                                    <td id="optionA-<?= $questionID ?>" hidden><?= $optionA ?></td>
                                    <td id="optionB-<?= $questionID ?>" hidden><?= $optionB ?></td>
                                    <td id="optionC-<?= $questionID ?>" hidden><?= $optionC ?></td>
                                    <td id="optionD-<?= $questionID ?>" hidden><?= $optionD ?></td>
                                    <td id="correctAnswer-<?= $questionID ?>"><?= $correctAnswer ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" onclick="updateQuestion(<?= $questionID ?>)"><i class="fa-solid fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="deleteQuestion(<?= $questionID ?>)"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>

                        </tbody>
                    </table>


                </div>
                
            </div>
			<!---End Questions--->	
<!---Exams--->
<div class="tab-pane fade" id="nav-exams" role="tabpanel" aria-labelledby="nav-exams-tab">
    <button type="button" class="btn btn-dark m-2 float-left" id="add-quiz-button" data-toggle="modal" data-target="#addExamModal">
        Add Exam
    </button>

    <div class="table-area">
        <table class="table" style="color: white;">
            <thead>
                <tr>
                    <th scope="col">Exam ID</th>
                    <th scope="col">Exam Name</th>
                    <th scope="col">Exam Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Prepare SQL query to fetch topics with related subject names
                $stmt = $conn->prepare('SELECT exam_id, exam_name, exam_description FROM tbl_exams');
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach ($result as $row) { 
                    $examID = $row['exam_id'];
                    $examName = $row['exam_name'];
                    $examDescription = $row['exam_description'];
                    ?>

                    <tr>
                        <th id="examID-<?= $examID ?>"><?= $examID ?></th>
                        <td id="examName-<?= $examID ?>"><?= $examName ?></td>
                        <td id="examDescription-<?= $examID ?>"><?= $examDescription ?></td>
                        <td>
                            <button type="button" class="btn btn-secondary" onclick="updateExam(<?= $examID ?>)"><i class="fa-solid fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger" onclick="deleteExam(<?= $examID ?>)"><i class="fa-solid fa-trash"></i></button>
							<button type="button" class="btn btn-success" onclick="showExam(<?= $examID ?>)"><i class="fa-solid fa-tasks"></i></button>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!---End Exams--->


				
			<!---Results--->	
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            <table class="table" style="color: white;">
                    <thead>
                        <tr>
                            <th scope="col">Result ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Year and Section</th>
                            <th scope="col">Quiz Score</th>
                            <th scope="col">Date Taken</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $stmt = $conn->prepare('SELECT * FROM `tbl_result`');
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach ($result as $row) { 
                                $resultID = $row['tbl_result_id'];
                                $studentName = $row['quiz_taker'];
                                $yearSection = $row['year_section'];
                                $totalScore = $row['total_score'];
                                $dateTaken = $row['date_taken'];
                                ?>

                                <tr>
                                    <th id="resultID-<?= $resultID ?>"><?= $resultID ?></th>
                                    <td id="studentName-<?= $resultID ?>"><?= $studentName ?></td>
                                    <td id="yearSection-<?= $resultID ?>"><?= $yearSection ?></td>
                                    <td id="totalScore-<?= $resultID ?>"><?= $totalScore ?></td>
                                    <td id="dateTaken-<?= $resultID ?>"><?= $dateTaken ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteResult(<?= $resultID ?>)"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
			<!---End Results--->
			
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
        </div>
        </div>
    </div>


</div>


<?php include ('./partials/footer.php') ?>