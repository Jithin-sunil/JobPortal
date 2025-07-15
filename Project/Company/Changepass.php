<?php
include("../Assets/Connection/Connection.php");
session_start();
 if(isset($_POST['btn_changepass']))
 {
    
	$oldpass=$_POST['txt_opass'];
	$newpass=$_POST['txt_opass2'];
	$retypepass=$_POST['txt_retypepass'];
	
	  $selQery="select * from tbl_company where company_id = '".$_SESSION['cid']."' ";
	  $row=$Con->query($selQery); 
	  $data=$row->fetch_assoc();
	  
	  $currentpass=$data['company_password'];

     if($oldpass == $currentpass)
	 {
		if($newpass == $retypepass)
		{
			$upQry = " update tbl_company set company_password = '".$newpass."' where company_id = '".$_SESSION['uid']."'";
		     if($Con->query($upQry))
		      {				  
			    ?>
                <script>
			    alert("password updated");
			    window.location="../Guest/Login.php";
			    </script>
			    <?php 
			   }
			  }
			  else
			  {
				?>
                <script>
			    alert("password not matching");
			    window.location="Changepass.php";
			    </script>
			    <?php   
			  }
			  
		}
		else
		{
			?>
<script>
			alert("Invalid Password");
			window.location="Changepass.php";
			</script>
			<?php 

		}
		 
	 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change password</title>
</head>

<body>
<div align="center">

<form action="" method="post">
<h3>Change Password</h3>
<table width="400" border="1">
  <tr>
    <td>Old Password</td>
    <td><label for="txt_opass"></label>
      <input type="password" name="txt_opass" id="txt_opass" /></td>
  </tr>
  <tr>
    <td>New Password</td>
    <td><label for="txt_opass2"></label>
      <input type="password" name="txt_opass2" id="txt_opass2" /></td>
  </tr>
  <tr>
    <td>Re-Type Password</td>
    <td><label for="txt_retypepass"></label>
      <input type="password" name="txt_retypepass" id="txt_retypepass" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_changepass" id="btn_changepass" value="Change Pasword" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
    </div></td>
    </tr>
</table>



</form>
</div>
</body>
</html>
