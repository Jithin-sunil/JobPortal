<?php
include("../Assets/Connection/Connection.php");
session_start();
 // PHPMailer setup
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../Assets/phpMail/src/Exception.php';
  require '../Assets/phpMail/src/PHPMailer.php';
  require '../Assets/phpMail/src/SMTP.php';

// Check if already applied
if (isset($_GET['eid'])) {
    $SelQry = "SELECT * FROM tbl_application WHERE jobpost_id='" . $_GET['eid'] . "' AND user_id='" . $_SESSION['uid'] . "'";
    $res = $Con->query($SelQry);
    if ($res->num_rows > 0) {
        echo "<script>alert('Already Applied'); window.location='Viewjobs.php';</script>";
        exit;
    }
}

// Application submission
if (isset($_POST['btn_submit'])) {
    $appli = $_FILES["txt_file"]['name'];
    $tempappli = $_FILES['txt_file']['tmp_name'];
    move_uploaded_file($tempappli, '../Assets/Files/User_Application/Application/' . $appli);

    $user_id = $_SESSION['uid'];
    $jobpost_id = $_GET['eid'];

    $insQry = "INSERT INTO tbl_application(application_date, application_file, user_id, jobpost_id) 
               VALUES (CURDATE(), '$appli', '$user_id', '$jobpost_id')";

    if ($Con->query($insQry)) {
        // Fetch user and job details
        $userQry = "SELECT * FROM tbl_user WHERE user_id = '$user_id'";
        $userRes = $Con->query($userQry);
        $userRow = $userRes->fetch_assoc();

        $jobQry = "SELECT * FROM tbl_jobpost j inner join tbl_company c on j.company_id=c.company_id inner join tbl_place p on p.place_id = c.place_id inner join tbl_district d on d.district_id=p.district_id inner join tbl_state s on s.state_id=d.state_id WHERE jobpost_id = '$jobpost_id'";
        $jobRes = $Con->query($jobQry);
        $jobRow = $jobRes->fetch_assoc();

       

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jithinsunil2003@gmail.com'; // Your Gmail
            $mail->Password = 'jberropyurlewonl'; // App Password (secure this in production)
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('jithinsunil2003@gmail.com', 'Job Portal');
            $mail->addAddress($userRow['user_email']); // Send to user

            $mail->isHTML(true);
            $mail->Subject = "Job Application Submitted - " . $jobRow['jobpost_title'];
            $mail->Body = "
                <h3>Application Confirmation</h3>
                <p>Dear <strong>{$userRow['user_name']}</strong>,</p>
                <p>You have successfully applied for the job: <strong>{$jobRow['jobpost_title']}</strong>.</p>
                <p><strong>Company:</strong> {$jobRow['company_name']}</p>
                <p><strong>Address:</strong> {$jobRow['company_address']},{$jobRow['place_name']},{$jobRow['district_name']},{$jobRow['state_name']}</p>
                <p><strong>Application Date:</strong> " . date("Y-m-d") . "</p>
                <br><p>Thank you for using our platform!</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "<script>alert('Mail could not be sent. Error: {$mail->ErrorInfo}');</script>";
        }

        //echo "<script>alert('Submitted Successfully'); window.location='MyApplication.php';</script>";
    } else {
        echo "<script>alert('Submission Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Apply for Job</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
  <div align="center">
    <h3>Apply for Job</h3>
    <table width="400" border="1" cellpadding="10">
      <tr>
        <td>Upload Resume / CV</td>
        <td><input type="file" name="txt_file" id="txt_file" required /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit Application" />
        </td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
