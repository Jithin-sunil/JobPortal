<?php
 include("../Assets/Connection/Connection.php");
 session_start();
 
 if(isset($_POST['btn_update']))
 {
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txt_address'];
	 
	  $upQry = "update tbl_company set company_name = '".$name."',company_email = '".$email."',company_contact = '".$contact."',company_address = '".$address."' where company_id = '".$_SESSION['cid']."' ";
	  if($Con->query($upQry))
	  {
		  ?>
		   <script>
		   alert(" Profile Updated Successfully");
	       window.location="Myprofile.php";
		 </script>
         <?php
	    }
		 else
		 {
		 ?>
          <script>
		    alert("UPDATION FAILED");
		    window.location="Editprofile.php";
		  </script>
		  
	<?php	  
	  }
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post" action="">
<h3>Edit Profile</h3>
<table width="200" border="1">
<?php
  $selQry = "select * from tbl_company where company_id = '".$_SESSION['cid']."' ";
  $row=$Con->query($selQry);
  $data=$row->fetch_assoc();
?>
  <tr>
    <td>Name</td>
    <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $data['company_name'] ?>" /></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $data['company_email'] ?>" /></td>
  </tr>
  <tr>
    <td>Contact</td>
    <td><label for="txt_contact"></label>
      <input type="number" name="txt_contact" id="txt_contact" value="<?php echo $data['company_contact'] ?>"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5"> <?php echo $data['company_address'] ?> </textarea></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_update" id="btn_update" value="Update" />
    </div></td>
    </tr>
</table>

</form>
</div
></body>
</html>
