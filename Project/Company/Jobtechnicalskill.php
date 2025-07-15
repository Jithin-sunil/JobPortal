<?php
 include("../Assets/Connection/Connection.php");
 session_start();
if(isset($_POST['btn_submit']))
{
	$jobtechnicalskill = $_POST['sel_techskill'];
	
	$insQry = "insert into tbl_jobtechnicalskill(technicalskill_id,jobpost_id) value('".$jobtechnicalskill."','".$_GET['tid']."') ";
if($Con->query($insQry))
	  {
	
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Jobtechnicalskill.php";
		</script>
		
	   <?php	
	  }
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Jobtechnicalskill.php";
		</script> 
			<?php 
	 }
 }	
 
 
 //remove
if(isset($_GET['rid']))
{
 $upQry	= "update tbl_jobtechnicalskill set jobtechnicalskill_status=1 where jobtechnicalskill_id='".$_GET['rid']."' ";
 if($Con->query($upQry))
 {
	 ?>
           <script>
	       alert("Removed");
	       window.location="Jobtechnicalskill.php";
	       </script>
     <?php 
 }	
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Technical Skill</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center"><h3>Job Technical Skill</h3>
<table width="200" border="1">
  <tr>
    <td>Technical Skill</td>
    <td><label for="sel_techskill"></label>
      <select name="sel_techskill" id="sel_techskill">
        <option>-select-</option>
         <?php
		$selQry = "select * from tbl_technicalskill where technicalskill_status = 0 ORDER BY technicalskill_name ASC";
		 $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
		    <option value ="<?php echo $data['technicalskill_id']?>"><?php echo $data['technicalskill_name']?></option>
              
			  <?php
			   }
              ?>
		
		
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
<h3>Job Technical Skill List</h3>
<table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Technical Skill</td>
    <td>Action </td>
  </tr>
   <?php
   $i=0;
   $selQry = "select * from tbl_jobtechnicalskill j inner join tbl_technicalskill t
   on j.technicalskill_id = t.technicalskill_id where jobtechnicalskill_status=0 ";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
     $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['technicalskill_name'] ?></td>
    <td>
    <a href = "Jobtechnicalskill.php?rid=<?php echo $data['jobtechnicalskill_id']?>">Remove</a>
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