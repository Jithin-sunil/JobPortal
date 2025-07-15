<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .exam-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .question-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .question-text {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .option {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .option:hover {
            background-color: #f0f0f0;
        }
        .option.selected {
            background-color: #d4edda;
            border-color: #28a745;
        }
        .option input {
            margin-right: 10px;
        }
        .question-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .next-button {
            width: 100%;
        }
        .timer {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
        }
        .exam-completed {
            text-align: center;
            font-size: 1.2rem;
            color: #28a745;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include('../Assets/Connection/Connection.php');

    $jid = isset($_GET['jid']) ? (int)$_GET['jid'] : 0;
    $user_id = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;

    $exam_id = 0;
     $exam_query = "SELECT exam_id FROM tbl_exam WHERE jobpost_id = $jid AND exam_status = 1 LIMIT 1";
    $exam_result = $Con->query($exam_query);
    if ($exam_result && $exam = $exam_result->fetch_assoc()) {
        $exam_id = $exam['exam_id'];
    } else {
        ?>
        <div class="exam-box exam-completed">
            <p>No active exam available for this job post.</p>
        </div>
        <?php
        exit;
    }

    $current_question_index = 0;
    $time_left = 15; 
    if ($exam_id && $user_id) {
        $timer_query = "SELECT current_question_index, time_left FROM tbl_examtimer WHERE user_id = $user_id AND exam_id = $exam_id LIMIT 1";
        $timer_result = $Con->query($timer_query);
        if ($timer_result && $timer = $timer_result->fetch_assoc()) {
            $current_question_index = $timer['current_question_index'];
            $time_left = $timer['time_left'];
        }
    }

    $questions = [];
    if ($exam_id) {
        $question_query = "SELECT q.question_id, q.question_title, q.question_file, q.questioncategory_id, qc.questioncategory_time 
                           FROM tbl_question q 
                           JOIN tbl_questioncategory qc ON q.questioncategory_id = qc.questioncategory_id 
                           WHERE q.exam_id = $exam_id AND q.question_status = 0";
        $question_result = $Con->query($question_query);
        $q_index = 0;
        while ($question = $question_result->fetch_assoc()) {
            $qid = $question['question_id'];
            $option_query = "SELECT option_id, option_options FROM tbl_option WHERE question_id = $qid";
            $option_result = $Con->query($option_query);
            $options = [];
            $opt_index = 0;
            while ($option = $option_result->fetch_assoc()) {
                $options[$opt_index] = [
                    'option_id' => $option['option_id'],
                    'text' => $option['option_options']
                ];
                $opt_index++;
            }
            $questions[$q_index] = [
                'id' => $qid,
                'question' => $question['question_title'],
                'image' => !empty($question['question_file']) ? '../Assets/Files/Questions/photo/' . $question['question_file'] : '',
                'options' => $options,
                'time' => $question['questioncategory_time']
            ];
            $q_index++;
        }
    }
    $total_questions = count($questions);
    if ($current_question_index >= $total_questions) {
        ?>
        <div class="exam-box exam-completed">
            <h3>Exam Completed</h3>
            <p>Thank you for completing the exam. The company will check the answers and notify you later.</p>
        </div>
        <?php
        exit;
    }
    $current_question = $questions[$current_question_index] ?? null;
    if ($current_question && $time_left == 15 && $current_question_index == 0) {
        $time_left = $current_question['time'];
        if ($user_id && $exam_id) {
            $check_timer_query = "SELECT timer_id FROM tbl_examtimer WHERE user_id = $user_id AND exam_id = $exam_id";
            $timer_result = $Con->query($check_timer_query);
            if ($timer_result && $timer_result->num_rows > 0) {
                $update_timer_query = "UPDATE tbl_examtimer SET time_left = $time_left WHERE user_id = $user_id AND exam_id = $exam_id";
                $Con->query($update_timer_query);
            } else {
                $insert_timer_query = "INSERT INTO tbl_examtimer (user_id, exam_id, current_question_index, time_left) 
                                       VALUES ($user_id, $exam_id, $current_question_index, $time_left)";
                $Con->query($insert_timer_query);
            }
        }
    }
    $selected_option_id = null;
    if ($current_question && $user_id) {
        $answer_query = "SELECT option_id FROM tbl_questionanswer WHERE user_id = $user_id AND question_id = {$current_question['id']}";
        $answer_result = $Con->query($answer_query);
        if ($answer_result && $answer = $answer_result->fetch_assoc()) {
            $selected_option_id = $answer['option_id'];
        }
    }
    ?>

    <div class="exam-box">
        <?php if ($current_question): ?>
            <div class="question-header">Question <span id="questionNumber"><?php echo $current_question_index + 1; ?></span> of <span id="totalQuestions"><?php echo $total_questions; ?></span></div>
            <div class="timer">Time Left: <span id="timeLeft"><?php echo $time_left; ?></span>s</div>
            <div class="question-text"><?php echo $current_question['question']; ?></div>
            <?php if ($current_question['image']): ?>
                <div class="question-image">
                    <img src="<?php echo $current_question['image']; ?>" alt="Question Image">
                </div>
            <?php endif; ?>
            <div id="options">
                <?php
                $opt_index = 0;
                while ($opt_index < count($current_question['options'])) {
                    $option = $current_question['options'][$opt_index];
                    $is_selected = ($selected_option_id == $option['option_id']) ? 'selected' : '';
                ?>
                    <div class="option <?php echo $is_selected; ?>" id="option<?php echo $opt_index; ?>">
                        <input type="radio" name="option" value="<?php echo $option['option_id']; ?>" id="opt<?php echo $opt_index; ?>" onchange="saveAnswer(<?php echo $current_question['id']; ?>, <?php echo $option['option_id']; ?>, <?php echo $opt_index; ?>)">
                        <label for="opt<?php echo $opt_index; ?>"><?php echo $option['text']; ?></label>
                    </div>
                <?php
                    $opt_index++;
                }
                ?>
            </div>
            <button class="btn btn-primary mt-3 next-button" onclick="nextQuestion()">Next</button>
        <?php else: ?>
            <div class="exam-completed">
                <p>No questions available for this exam.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        let timeLeft = <?php echo $time_left; ?>;
        let currentQuestionIndex = <?php echo $current_question_index; ?>;
        const totalQuestions = <?php echo $total_questions; ?>;
        let timer;

        function startTimer() {
            clearInterval(timer);
            document.getElementById('timeLeft').textContent = timeLeft;
            timer = setInterval(() => {
                timeLeft--;
                document.getElementById('timeLeft').textContent = timeLeft;
                $.ajax({
                    url: '../Assets/AjaxPages/AjaxExam.php',
                    method: 'POST',
                    data: {
                        action: 'update_timer',
                        user_id: <?php echo $user_id; ?>,
                        exam_id: <?php echo $exam_id; ?>,
                        current_question_index: currentQuestionIndex,
                        time_left: timeLeft
                    }
                });
                if (timeLeft <= 0) {
                    nextQuestion();
                }
            }, 1000);
        }

        function saveAnswer(questionId, optionId, optionIndex) {
            let options = document.querySelectorAll('.option');
            let i = 0;
            while (i < options.length) {
                options[i].classList.remove('selected');
                i++;
            }
            document.getElementById('option' + optionIndex).classList.add('selected');
            $.ajax({
                url: '../Assets/AjaxPages/AjaxExam.php',
                method: 'POST',
                data: {
                    action: 'save_answer',
                    user_id: <?php echo $user_id; ?>,
                    exam_id: <?php echo $exam_id; ?>,
                    question_id: questionId,
                    option_id: optionId
                }
            });
        }

        function nextQuestion() {
            clearInterval(timer);
            currentQuestionIndex++;
            $.ajax({
                url: '../Assets/AjaxPages/AjaxExam.php',
                method: 'POST',
                data: {
                    action: 'get_next_question_time',
                    exam_id: <?php echo $exam_id; ?>,
                    current_question_index: currentQuestionIndex
                },
                success: function(response) {
                    timeLeft = parseInt(response) || 15;
                    $.ajax({
                        url: '../Assets/AjaxPages/AjaxExam.php',
                        method: 'POST',
                        data: {
                            action: 'update_timer',
                            user_id: <?php echo $user_id; ?>,
                            exam_id: <?php echo $exam_id; ?>,
                            current_question_index: currentQuestionIndex,
                            time_left: timeLeft
                        },
                        success: () => window.location.reload()
                    });
                }
            });
        }

        startTimer();
    </script>
</body>
</html>