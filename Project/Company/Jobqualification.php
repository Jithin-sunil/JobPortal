<?php
 include("../Assets/Connection/Connection.php");
 session_start();
if(isset($_POST['btn_submit']))
{
	  $jobqualification=$_POST['sel_qualification'];	

	  $insQry = "insert into tbl_jobqualification(qualification_id,jobpost_id)values ('".$jobqualification."','".$_GET['pid']."')";
	  if($Con->query($insQry))
	  {
	
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Jobqualification.php";
		</script>
		
	   <?php	
	  }
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Jobqualification.php";
		</script> 
			<?php 
	 }
 }


//remove
if(isset($_GET['rid']))
{
 $upQry	= "update tbl_jobqualification set jobqualification_status=1 where jobqualification_id='".$_GET['rid']."' ";
 if($Con->query($upQry))
 {
	 ?>
           <script>
	       alert("Removed");
	       window.location="Jobqualification.php";
	       </script>
     <?php 
 }	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Qualification</title>
</head>

<body>
<form action="" method="post">
<div align="center"><h3>Job Qualification</h3>
<table width="200" border="1">
  <tr>
    <td width="139">Qualification</td>
    <td width="45"><label for="sel_qualification"></label>
      <select name="sel_qualification" id="sel_qualification">
        <option>-select-</option>
        <?php
		 $selQry="select * from tbl_qualification where qualification_status=0 ORDER BY qualification_name ASC";
	     $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
			  <option value ="<?php echo $data['qualification_id']?>"><?php echo $data['qualification_name']?></option>
              
			  <?php
			   }
              ?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<h3>Job Qualification List</h3>
<table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Qualification</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry = "select * from tbl_jobqualification j inner join tbl_qualification q
   on j.qualification_id = q.qualification_id where jobqualification_status=0 ";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
     $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['qualification_name']?></td>
    <td>
    <a href = "Jobqualification.php?rid=<?php echo $data['jobqualification_id']?>">Remove</a>
    </td>
    <?php
   }
	?>
  </tr>
</table>
</div>
</form>
</body>
</html>