<!-- Add Question Modal -->
<div class="modal fade mt-5" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestion" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestion">Add Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-question.php" method="POST">
                    <div class="form-group">
                        <label for="questionTitle">Question</label>
                        <input type="text" class="form-control" id="questionTitle" name="question_title">
                    </div>
                    <div class="form-group">
                        <label for="optionA">Option A</label>
                        <input type="text" class="form-control" id="optionA" name="option_a">
                    </div>
                    <div class="form-group">
                        <label for="optionB">Option B</label>
                        <input type="text" class="form-control" id="optionB" name="option_b">
                    </div>
                    <div class="form-group">
                        <label for="optionC">Option C</label>
                        <input type="text" class="form-control" id="optionC" name="option_c">
                    </div>
                    <div class="form-group">
                        <label for="optionD">Option D</label>
                        <input type="text" class="form-control" id="optionD" name="option_d">
                    </div>
                    <div class="form-group">
                        <label for="correctAnswer">Correct Answer (Letter Only)</label>
                        <input type="text" class="form-control" id="correctAnswer" name="correct_answer">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Question Modal -->
<div class="modal fade mt-5" id="updateQuestionModal" tabindex="-1" aria-labelledby="updateQuestion" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/update-question.php" method="POST">
                    <div class="form-group" hidden>
                        <label for="updateQuestionID">Question ID</label>
                        <input type="text" class="form-control" id="updateQuestionID" name="question_id">
                    </div>
                    <div class="form-group">
                        <label for="updateQuestionTitle">Question</label>
						<textarea class="form-control" id="updateQuestionTitle" name="question_title" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="updateOptionA">Option A</label>
                        <input type="text" class="form-control" id="updateOptionA" name="option_a">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionB">Option B</label>
                        <input type="text" class="form-control" id="updateOptionB" name="option_b">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionC">Option C</label>
                        <input type="text" class="form-control" id="updateOptionC" name="option_c">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionD">Option D</label>
                        <input type="text" class="form-control" id="updateOptionD" name="option_d">
                    </div>
                    <div class="form-group">
                        <label for="updateCorrectAnswer">Correct Answer (Letter Only)</label>
                        <input type="text" class="form-control" id="updateCorrectAnswer" name="correct_answer">
                    </div>
                    <div class="form-group">
                        <label for="updateQuestionTopic">Topic</label>
                        <select class="form-control" id="updateQuestionTopic" name="question_topic">
                            <?php 
							// Move this one to external file for inclusion and neatness
							//include("./partials/subject_options.php"); 
							// Fetch subjects from tbl_subjects
								$stmt = $conn->prepare('SELECT * FROM `tbl_topics`');
								$stmt->execute();
								$topics = $stmt->fetchAll();

								// Output options for select dropdown
								foreach ($topics as $topic) {
									$topicID = $topic['topic_id'];
									$topicName = $topic['topic_name'];
									echo "<option value='$topicID'>$topicName</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal fade mt-5" id="resultModal" tabindex="-1" aria-labelledby="resultModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="result">Result</h5>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-result.php" method="POST">
                    <div class="form-group">
                        <label for="quizTaker">Student Fullname</label>
                        <input type="text" class="form-control" id="quizTaker" name="quiz_taker">
                    </div>
                    <div class="form-group">
                        <label for="yearSection">Year and Section</label>
                        <input type="text" class="form-control" id="yearSection" name="year_section">
                    </div>
                    <div class="form-group">
                        <label for="totalScore">Total Score</label>
                        <input type="text" class="form-control" id="totalScore" name="total_score" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Subject Modal -->
<div class="modal fade mt-5" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubject">Add Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-subject.php" method="POST">
                    <div class="form-group">
                        <label for="subjectName">Subject</label>
                        <input type="text" class="form-control" id="subjectName" name="subject_name">
                    </div>
                    <div class="form-group">
                        <label for="subjectDescription">Description</label>
                        <input type="text" class="form-control" id="subjectDescription" name="subject_description">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Subject Modal -->
<div class="modal fade mt-5" id="updateSubjectModal" tabindex="-1" aria-labelledby="updateSubject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateSubjectForm">
                    <div class="form-group" hidden>
                        <label for="updateSubjectID">Subject ID</label>
                        <input type="text" class="form-control" id="updateSubjectID" name="subject_id">
                    </div>
                    <div class="form-group">
                        <label for="updateSubjectName">Subject Name</label>
                        <input type="text" class="form-control" id="updateSubjectName" name="subject_name">
                    </div>
                    <div class="form-group">
                        <label for="updateSubjectDescription">Subject Description</label>
                        <textarea class="form-control" id="updateSubjectDescription" name="subject_description" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Topic Modal -->
<div class="modal fade mt-5" id="addTopicModal" tabindex="-1" aria-labelledby="addTopic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Topic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-topic.php" method="POST">
                    <div class="form-group">
                        <label for="topicName">Topic Name</label>
                        <input type="text" class="form-control" id="topicName" name="topic_name">
                    </div>
                    <div class="form-group">
                        <label for="topicDescription">Topic Description</label>
                        <textarea class="form-control" id="topicDescription" name="topic_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="subjectID">Subject</label>
                        <select class="form-control" id="topicSubject" name="subject_id">
                            <?php 
							// Move this one to external file for inclusion and neatness
							//include("./partials/subject_options.php"); 
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
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Add Topic</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Update Topic Modal -->
<div class="modal fade mt-5" id="updateTopicModal" tabindex="-1" aria-labelledby="updateTopic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Topic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTopicForm">
                    <div class="form-group" hidden>
                        <label for="updateTopicID">Topic ID</label>
                        <input type="text" class="form-control" id="updateTopicID" name="topic_id">
                    </div>
                    <div class="form-group">
                        <label for="updateTopicName">Topic Name</label>
                        <input type="text" class="form-control" id="updateTopicName" name="topic_name">
                    </div>
                    <div class="form-group">
                        <label for="updateTopicDescription">Topic Description</label>
                        <textarea class="form-control" id="updateTopicDescription" name="topic_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="updateTopicSubject">Subject</label>
                        <select class="form-control" id="updateTopicSubject" name="subject_id">
                            <?php 
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
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Exam Modal -->
<div class="modal fade mt-5" id="addExamModal" tabindex="-1" aria-labelledby="addExam" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-exam.php" method="POST">
                    <div class="form-group">
                        <label for="examName">Exam Name</label>
                        <input type="text" class="form-control" id="examName" name="exam_name">
                    </div>
                    <div class="form-group">
                        <label for="examDescription">Exam Description</label>
                        <textarea class="form-control" id="examDescription" name="exam_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="examStartDate">Start Date</label>
                        <input type="datetime-local" class="form-control" id="examStartDate" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="examEndDate">End Date</label>
                        <input type="datetime-local" class="form-control" id="examEndDate" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Add Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Exam Modal action="./endpoint/update-exam.php" method="POST"-->
<div class="modal fade mt-5" id="updateExamModal" tabindex="-1" aria-labelledby="updateExam" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateExamForm">
                    <div class="form-group" hidden>
                        <label for="updateExamID">Exam ID</label>
                        <input type="text" class="form-control" id="updateExamID" name="exam_id">
                    </div>
                    <div class="form-group">
                        <label for="updateExamName">Exam Name</label>
                        <input type="text" class="form-control" id="updateExamName" name="exam_name">
                    </div>
                    <div class="form-group">
                        <label for="updateExamDescription">Exam Description</label>
                        <textarea class="form-control" id="updateExamDescription" name="exam_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="updateExamStartDate">Start Date</label>
                        <input type="datetime-local" class="form-control" id="updateExamStartDate" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="updateExamEndDate">End Date</label>
                        <input type="datetime-local" class="form-control" id="updateExamEndDate" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
