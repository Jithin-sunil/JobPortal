<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$qualification_id=$_POST["sel_qualification"];
	$certificate=$_FILES["file_certificate"] ['name'];
    $tempcertificate=$_FILES['file_certificate'] ['tmp_name'];
   move_uploaded_file($tempcertificate,'../Assets/Files/User_Qualification/Certificate/'.$certificate);

	
	
	$insQry=" insert into tbl_userqualification(qualification_id, userqualification_certificate, user_id) values ('".$qualification_id."','".$certificate."','".$_SESSION['uid']."')";
	 if($Con->query($insQry))
  {
	  ?>
      <script>
	  alert("Submitted Successfully");
	  window.location="Userqualification.php";
	  </script>
      <?php
   }
    else
    {
	  ?>
<script>
	  alert("Wrong submission");
	  window.location="Userqualification.php";
	  </script>
      <?php
   }
}

#remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_userqualification set userqualification_status=1 where userqualification_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Userqualification.php";
	  </script> 	
      <?php
	
}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> User Qualification</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
 <div align="center">
<h3> User Qualification</h3><table width="200" border="1">
  <tr>
    <td>Qualification</td>
    <td><label for="sel_qualification"></label>
      <select name="sel_qualification" id="sel_qualification">
        <option align="center">select</option>
        <?php
		$selQry="select * from  tbl_qualification where qualification_status=0";
		$row=$Con->query($selQry);
		   while($data=$row->fetch_assoc())
		   {
		 ?>
           <option value="<?php echo $data['qualification_id']?>"><?php
		  echo $data['qualification_name']?></option>
         
         <?php
		   }
		 ?>
      </select></td>
  </tr>
  <tr>
    <td>Certificate</td>
    <td><label for="file_certificate"></label>
      <input type="file" name="file_certificate" id="file_certificate" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<h3>List</h3><table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Qualification</td>
    <td>Certificate</td>
    <td>Action</td>
  </tr>
   <?php
   $i=0;
    $selQry="select * from tbl_userqualification u
    inner join tbl_qualification q on u.qualification_id = q.qualification_id  
	where userqualification_status=0 and user_id='".$_SESSION['uid']."'";
   	$row=$Con->query($selQry);
	 while($data=$row->fetch_assoc())
	 {
		 
		 $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['qualification_name'] ?></td>
    <td> <img src="../Assets/Files/User_Qualification/Certificate/<?php echo $data['userqualification_certificate']?>" width="150" height="150"></td>
    <td>
     <a href  = "Userqualification.php?rid=<?php echo $data['userqualification_id'] ?>">remove</a>
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