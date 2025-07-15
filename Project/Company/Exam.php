<?php
include("../Assets/Connection/Connection.php");

session_start();
if(isset($_POST['btn_submit']))
{	
	$examdate = $_POST['txt_date'];	
	
	$insQry = "insert into tbl_exam(jobpost_id,exam_date) values ('".$_GET['eid']."','".$examdate."')";

   if($Con->query($insQry))
	  {
	
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Exam.php?eid=<?php echo $_GET['eid']?>";
		</script>
		
	   <?php	
	  }
     else
	 {
		  ?>
<script>
		alert("Insertion Failed");
		window.location="Exam.php?eid=<?php echo $_GET['eid']?>";
		</script> 
			<?php 
	 }
 }	
	
//remove
if(isset($_GET['rid']))
{
 $upQry	= "update tbl_exam set exam_status=1 where exam_id='".$_GET['rid']."' ";
 if($Con->query($upQry))
 {
	 ?>
<script>
	       alert("Removed");
	       window.location="Exam.php?eid=<?php echo $_GET['eid']?>";
	       </script>
     <?php 
 }	
}	

if(isset($_GET['sid']))
{
 $upQry	= "update tbl_exam set exam_status='".$_GET['sts']."' where exam_id='".$_GET['sid']."' ";
 if($Con->query($upQry))
 {
   ?><script>
         alert("Exam Started");
         window.location="Exam.php?eid=<?php echo $_GET['eid']?>";
         </script>
     <?php  
  }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam Date Declaration</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center">
  <h3>Exam Date Declaration</h3>
<table width="200" border="1">
  <tr>
    <td>Exam Date</td>
    <td><label for="txt_date"></label>
      <input type="datetime-local" name="txt_date"  required></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table><p>&nbsp;</p>
<h3>Exam Date Declaration List </h3>
<table width="250" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Exam Date</td>
    <td>Action</td>
  </tr>
   <?php
   $i=0;
   $selQry = "select * from tbl_exam where  jobpost_id = '".$_GET['eid']."' ";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
     $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['exam_datetime']?></td>
    <td>
    <a href = "Exam.php?rid=<?php echo $data['exam_id']?>">Remove</a>
    <a href="Questions.php?eid=<?php echo $data['exam_id']?>">Add Question</a>
  
<?php
    if($data['exam_status'] == 0)
    {
      ?>
      <a href="Exam.php?sid=<?php echo $data['exam_id']?>&sts=1">Start Exam</a>
      <?php
    }
    if($data['exam_status'] == 1)
    {
      ?>
      <a href="Exam.php?sid=<?php echo $data['exam_id']?>&sts=2">End Exam</a>
      <?php
    }
    else
    {
      echo "Exam Completed";
    }
    
    ?>

  </td>
    
 
    
    
  </tr>
  <?php
    }
	?>
</table>
</div>
</form>
</body>
</html>