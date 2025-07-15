<?php
  include("../Assets/Connection/Connection.php");
  session_start();
  
  
 //accept
 if(isset($_GET['aid']))
  {

   $upQry = "update tbl_application set application_status = 1 where application_id = '".$_GET['aid']."' ";
   if($Con->query($upQry))
   {
	?>   
	   <script>
	         alert("Accepted");
	         window.location="RejectedApplicant.php";
	        </script>
            
      
  <?php
   }
  }
  ?>       
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rejected Applicant</title>
</head>

<body>
<div align="center">
<h3>Rejected Applicants</h3>
<table width="700" border="1">
  <tr>
    <td>Sl.No</td>
    <td>User Details</td>
    <td>Job Details</td>
    <td>Apply Date</td>
    <td>Action</td>
  </tr>
   <?php
  $i=0;
  $selQry="select * from tbl_application a 
   inner join tbl_user u on a.user_id = u.user_id 
   inner join tbl_jobpost p on a.jobpost_id = p.jobpost_id
   inner join tbl_company c on c.company_id=p.company_id 
   where c.company_id = '".$_SESSION['cid']."' and  a.application_status = 2";
    $row=$Con->query($selQry);
	 while($data=$row->fetch_assoc())
	 {
		 
		 $i++;
  
  ?>

    <tr>
      <td><?php  echo $i?></td>
    <td>
       <?php  echo "Name :"," ",$data['user_name']; ?><br/><br/>
      <?php  echo "Contact :"," ",$data['user_contact']; ?><br/><br/>
      <?php  echo "Email :"," ",$data['user_email']; ?><br/><br/>
      <?php  echo "Address :"," ",$data['user_address']; ?>
    </td>
    <td>
    <?php  echo "Job Post :"," ",$data['jobpost_title']; ?><br/><br/>
	<?php  echo "Experience :"," ",$data['jobpost_experience']; ?>  
    </td>
    <td><?php  echo $data['application_date'] ?></td>
    <td>
  <a href = "RejectedApplicant.php?aid=<?php echo $data['application_id']?>">Accept</a><br/>
    </td>
  </tr>
  <?php
   }
  ?>
</table>
</body>
</html>