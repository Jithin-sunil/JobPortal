<?php
session_start();
include('../Assets/Connection/Connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

$jid = isset($_GET['jid']) ? (int)$_GET['jid'] : 0;


$exam_query = "SELECT exam_id FROM tbl_exam WHERE jobpost_id = $jid AND exam_status = 2 LIMIT 1";
$exam_result = $Con->query($exam_query);
if (!$exam_result || !$exam = $exam_result->fetch_assoc()) {
    echo "<script>alert('No completed exam found for this job post.'); window.location='JobList.php';</script>";
    exit;
}
$exam_id = $exam['exam_id'];

$jobQry = "SELECT j.jobpost_title, c.company_name, c.company_address, p.place_name, d.district_name, s.state_name 
           FROM tbl_jobpost j 
           INNER JOIN tbl_company c ON j.company_id = c.company_id 
           INNER JOIN tbl_place p ON p.place_id = c.place_id 
           INNER JOIN tbl_district d ON d.district_id = p.district_id 
           INNER JOIN tbl_state s ON s.state_id = d.state_id 
           WHERE j.jobpost_id = $jid";
$jobRes = $Con->query($jobQry);
$jobRow = $jobRes->fetch_assoc();

$category_query = "SELECT questioncategory_id, questioncategory_mark FROM tbl_questioncategory WHERE questioncategory_id IN (SELECT questioncategory_id FROM tbl_question WHERE exam_id = $exam_id)";
$category_result = $Con->query($category_query);
$categories = [];
$max_possible_marks = 0;
while ($category = $category_result->fetch_assoc()) {
    $cat_id = $category['questioncategory_id'];
    $mark = $category['questioncategory_mark'];
    $categories[$cat_id] = $mark;
    $question_query = "SELECT COUNT(*) as total FROM tbl_question WHERE exam_id = $exam_id AND questioncategory_id = $cat_id";
    $question_result = $Con->query($question_query);
    $total_questions = $question_result->fetch_assoc()['total'];
    $max_possible_marks += $total_questions * $mark;
}
$pass_mark = $max_possible_marks * 0.5; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_interview'])) {
    $user_id = (int)$_POST['user_id'];
    $user_email = $_POST['user_email'];
    $interview_date = $_POST['interview_date'];
    $interview_time = $_POST['interview_time'];
    $interview_location = $_POST['interview_location'];

    $userQry = "SELECT user_name FROM tbl_user WHERE user_id = '$user_id'";
    $userRes = $Con->query($userQry);
    $userRow = $userRes->fetch_assoc();

    $appQry = "SELECT application_id FROM tbl_application WHERE user_id = '$user_id' AND jobpost_id = '$jid'";
    $appRes = $Con->query($appQry);
    if ($appRes->num_rows == 0) {
        echo "<script>alert('No application found for this user and job post.');</script>";
    } else {
      
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jithinsunil2003@gmail.com';
            $mail->Password = 'jberropyurlewonl'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('jithinsunil2003@gmail.com', 'Job Portal');
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = "Interview Invitation for {$jobRow['jobpost_title']}";
            $mail->Body = "
                <h3>Interview Invitation</h3>
                <p>Dear <strong>{$userRow['user_name']}</strong>,</p>
                <p>Congratulations! You have qualified for the interview for the job: <strong>{$jobRow['jobpost_title']}</strong>.</p>
                <p><strong>Interview Details:</strong></p>
                <p><strong>Date:</strong> $interview_date</p>
                <p><strong>Time:</strong> $interview_time</p>
                <p><strong>Location/Address:</strong> $interview_location</p>
                <p><strong>Company:</strong> {$jobRow['company_name']}</p>
                <p><strong>Address:</strong> {$jobRow['company_address']}, {$jobRow['place_name']}, {$jobRow['district_name']}, {$jobRow['state_name']}</p>
                <br><p>We look forward to meeting you!</p>
                <p>Best Regards,<br>Hiring Team</p>
            ";

            $mail->send();

            $updateQry = "UPDATE tbl_application SET application_status = 3 WHERE user_id = '$user_id' AND jobpost_id = '$jid'";
            if ($Con->query($updateQry)) {
                echo "<script>alert('Interview invitation sent successfully to $user_email and application status updated.');</script>";
            } else {
                echo "<script>alert('Interview invitation sent, but failed to update application status.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Mail could not be sent. Error: {$mail->ErrorInfo}');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Exam Results</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .modal.active, .modal-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
<div align="center">
    <?php
    $user_query = "SELECT u.user_id, u.user_name, u.user_email FROM tbl_user u 
                   JOIN tbl_questionanswer qa ON u.user_id = qa.user_id 
                   WHERE qa.question_id IN (SELECT question_id FROM tbl_question WHERE exam_id = $exam_id) 
                   GROUP BY u.user_id";
    $user_result = $Con->query($user_query);

    if ($user_result->num_rows == 0) {
        echo "<p>No candidates have completed the exam.</p>";
    } else {
    ?>
        <table width="900" border="1">
            <tr>
                <th>Sl.No</th>
                <th>User Name</th>
                <th>Email</th>
                <?php foreach ($categories as $cat_id => $mark) { ?>
                    <th>Category <?php echo $cat_id; ?><br/>(Mark/Q: <?php echo $mark; ?>)</th>
                <?php } ?>
                <th>Total Marks</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            while ($user = $user_result->fetch_assoc()) {
                $i++;
                $user_id = $user['user_id'];
                $total_marks = 0;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['user_email']; ?></td>
                    <?php
                    foreach ($categories as $cat_id => $mark) {
                        $question_query = "SELECT question_id FROM tbl_question WHERE exam_id = $exam_id AND questioncategory_id = $cat_id";
                        $question_result = $Con->query($question_query);
                        $total_questions = $question_result->num_rows;
                        $correct_count = 0;
                        $cat_marks = 0;

                        while ($question = $question_result->fetch_assoc()) {
                            $qid = $question['question_id'];
                            $answer_query = "SELECT o.option_iscorrect FROM tbl_questionanswer qa 
                                             JOIN tbl_option o ON qa.option_id = o.option_id 
                                             WHERE qa.user_id = $user_id AND qa.question_id = $qid";
                            $answer_result = $Con->query($answer_query);
                            if ($answer_result && $answer = $answer_result->fetch_assoc()) {
                                if ($answer['option_iscorrect'] == 1) {
                                    $correct_count++;
                                    $cat_marks += $mark;
                                }
                            }
                        }
                        $total_marks += $cat_marks;
                    ?>
                        <td><?php echo "$correct_count/$total_questions<br>(Marks: $cat_marks)"; ?></td>
                    <?php } ?>
                    <td><?php echo $total_marks; ?></td>
                    <td>
                        <a href="#" onclick="showInterviewForm('<?php echo $user_id; ?>', '<?php echo $user['user_email']; ?>')">Send Interview Notification</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>




    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modal" id="interview-modal">
        <h3>Send Interview Invitation</h3>
        <form method="POST" action="">
            <input type="hidden" name="user_id" id="form-user-id">
            <input type="hidden" name="user_email" id="form-user-email">
            <p>
                <label>Date:</label><br>
                <input type="date" name="interview_date" required>
            </p>
            <p>
                <label>Time:</label><br>
                <input type="time" name="interview_time" required>
            </p>
            <p>
                <label>Location/Address:</label><br>
                <textarea name="interview_location" required></textarea>
            </p>
            <p>
                <input type="submit" name="send_interview" value="Send Invitation">
                <button type="button" onclick="hideInterviewForm()">Cancel</button>
            </p>
        </form>
    </div>
</div>

<script>
function showInterviewForm(userId, userEmail) {
    document.getElementById('form-user-id').value = userId;
    document.getElementById('form-user-email').value = userEmail;
    document.getElementById('interview-modal').classList.add('active');
    document.getElementById('modal-overlay').classList.add('active');
}

function hideInterviewForm() {
    document.getElementById('interview-modal').classList.remove('active');
    document.getElementById('modal-overlay').classList.remove('active');
}
</script>
</body>
</html>