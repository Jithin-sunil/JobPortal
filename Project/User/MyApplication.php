<?php
include("../Assets/Connection/Connection.php");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Application</title>
</head>

<body>
<div align="center">
<h3>My Application</h3>
<table width="700" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Job Details</td>
    <td>Company Details</td>
    <td>Apply Date</td>
    <td>Status</td>
  </tr>
  <?php
  $i = 0;
  $selQry = "SELECT *
             FROM tbl_application a
             INNER JOIN tbl_jobpost p ON a.jobpost_id = p.jobpost_id
             INNER JOIN tbl_company c ON p.company_id = c.company_id
             LEFT JOIN tbl_exam e ON a.jobpost_id = e.jobpost_id 
             WHERE a.user_id = '" .$_SESSION['uid'] . "'";
  $row = $Con->query($selQry);
  while ($data = $row->fetch_assoc()) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td>
        Job Post: <?php echo $data['jobpost_title']; ?><br/><br/>
        Experience: <?php echo $data['jobpost_experience']; ?>
    </td>
    <td>
        Name: <?php echo $data['company_name']; ?><br/><br/>
        Contact: <?php echo $data['company_contact']; ?><br/><br/>
        Email: <?php echo $data['company_email']; ?>
    </td>
    <td><?php echo $data['application_date']; ?></td>
    <td>
        <?php
        if ($data['application_status'] == 0) {
            echo "Application Pending.";
        } elseif ($data['application_status'] == 1) {
            echo "Application Accepted.";
            if (($data['exam_datetime']  == date('Y-m-d')) && ($data['exam_status'] == 1)) {
                echo "<br/><a href='Exam.php?jid=" . $data['jobpost_id'] . "'>Start Exam</a>";
            }
            else if ($data['exam_status']==2)
            {
                echo "Exam Ended.";
            }
            else {
                echo "<br/>Exam Date: " . $data['exam_datetime'];
            }
        } else {
            echo "Application Rejected.";
        }
        ?>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>