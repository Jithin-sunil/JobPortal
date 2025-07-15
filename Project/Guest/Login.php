<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_login']))
{
  	$email=$_POST['txt_email'];
	$Password=$_POST['txt_password'];
	
	
	//User
	$selUser="select * from tbl_user where user_email='".$email."' and user_password='".$Password."'";
	$rowUser=$Con->query($selUser);
	
	
	//Company
	$selComp="select * from tbl_company where company_email='".$email."' and company_password='".$Password."'";
	$rowComp=$Con->query($selComp);
	
	
	if($dataUser=$rowUser->fetch_assoc())
	{
		$_SESSION['uid']=$dataUser['user_id'];
		$_SESSION['uname']=$dataUser['user_name'];
		header("location:../User/Homepage.php");
		
	}
	else if($dataComp=$rowComp->fetch_assoc())
	{
		$_SESSION['cid']=$dataComp['company_id'];
		$_SESSION['cname']=$dataComp['company_name'];
		header("location:../Company/Homepage.php");
		
	}
	
	else
	{
		 
		  ?>
		<script>
		alert("Login Failed");
		window.location="Login.php";
		</script> 
			<?php 
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
 <div align="center">
   <h3>Login</h3>
   <table width="200" border="1">
     <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
        <input type="email" name="txt_email" id="txt_email" placeholder="Enter Your Email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
        <input type="password" name="txt_password" id="txt_password" placeholder="Enter Your Password"/></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_login" id="btn_login" value="Login" />
      </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
