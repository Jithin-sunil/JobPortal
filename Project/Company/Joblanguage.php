<?php
 include("../Assets/Connection/Connection.php");
 session_start();
if(isset($_POST['btn_submit']))
{
	$joblanguage = $_POST['sel_language'];
	
	$insQry = "insert into tbl_joblanguage(jobpost_id,language_id) values('".$_GET['lid']."','".$joblanguage."') ";
if($Con->query($insQry))
	  {
	
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Joblanguage.php";
		</script>
		
	   <?php	
	  }
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Joblanguage.php";
		</script> 
			<?php 
	 }
 }	
	
//remove
if(isset($_GET['rid']))
{
 $upQry	= "update tbl_joblanguage set joblanguage_status=1 where joblanguage_id='".$_GET['rid']."' ";
 if($Con->query($upQry))
 {
	 ?>
           <script>
	       alert("Removed");
	       window.location="Joblanguage.php";
	       </script>
     <?php 
 }	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Language</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center"><h3>Job Language </h3>
<table width="200" border="1">
  <tr>
    <td>Language</td>
    <td><label for="sel_language"></label>
      <select name="sel_language" id="sel_language">
        <option>-select-</option>
        <?php
		$selQry = "select * from tbl_language where language_status = 0 ORDER BY language_name ASC";
		 $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
			  <option value ="<?php echo $data['language_id']?>"><?php echo $data['language_name']?></option>
              
			  <?php
			   }
              ?>
		
		
		?>
      </select></td>
  </tr>
  <tr>
    <td height="26" colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<h3>Job Language List </h3>
<table width="200" border="1">
  <tr>
    <td>Sl No</td>
    <td>Language</td>
    <td>Action</td>
  </tr>
   <?php
   $i=0;
   $selQry = "select * from tbl_joblanguage j inner join tbl_language l
   on j.language_id = l.language_id where joblanguage_status=0 ";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
     $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['language_name']?></td>
    <td>
    <a href = "Joblanguage.php?rid=<?php echo $data['joblanguage_id']?>">Remove</a>
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