<?php
session_start();
include('../Connection/Connection.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;

if ($action === 'save_answer' && $user_id) {
    $exam_id = (int)$_POST['exam_id'];
    $question_id = (int)$_POST['question_id'];
    $option_id = (int)$_POST['option_id'];
    $questionanswer_date = date('Y-m-d H:i:s');

    $check_query = "SELECT answer_id FROM tbl_questionanswer WHERE user_id = $user_id AND question_id = $question_id";
    $result = $Con->query($check_query);

    if ($result && $result->num_rows > 0) {
        $update_query = "UPDATE tbl_questionanswer SET option_id = $option_id, questionanswer_date = '$questionanswer_date' 
                         WHERE user_id = $user_id AND question_id = $question_id";
        $Con->query($update_query);
    } else {
        $insert_query = "INSERT INTO tbl_questionanswer (user_id, option_id, question_id, questionanswer_date) 
                         VALUES ($user_id, $option_id, $question_id, '$questionanswer_date')";
        $Con->query($insert_query);
    }
    echo 'Answer saved';
} elseif ($action === 'update_timer' && $user_id) {
    $exam_id = (int)$_POST['exam_id'];
    $current_question_index = (int)$_POST['current_question_index'];
    $time_left = (int)$_POST['time_left'];

    $check_query = "SELECT timer_id FROM tbl_examtimer WHERE user_id = $user_id AND exam_id = $exam_id";
    $result = $Con->query($check_query);

    if ($result && $result->num_rows > 0) {
        $update_query = "UPDATE tbl_examtimer SET current_question_index = $current_question_index, time_left = $time_left 
                         WHERE user_id = $user_id AND exam_id = $exam_id";
        $Con->query($update_query);
    } else {
        $insert_query = "INSERT INTO tbl_examtimer (user_id, exam_id, current_question_index, time_left) 
                         VALUES ($user_id, $exam_id, $current_question_index, $time_left)";
        $Con->query($insert_query);
    }
    echo 'Timer updated';
} elseif ($action === 'get_next_question_time') {
    $exam_id = (int)$_POST['exam_id'];
    $current_question_index = (int)$_POST['current_question_index'];
    $query = "SELECT qc.questioncategory_time 
              FROM tbl_question q 
              JOIN tbl_questioncategory qc ON q.questioncategory_id = qc.questioncategory_id 
              WHERE q.exam_id = $exam_id AND q.question_status = 0 
              LIMIT 1 OFFSET $current_question_index";
    $result = $Con->query($query);
    if ($result && $row = $result->fetch_assoc()) {
        echo $row['questioncategory_time'];
    } else {
        echo '15'; 
    }
} else {
    echo 'Invalid request';
}

?>