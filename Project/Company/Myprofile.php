<?php
 include("../Assets/Connection/Connection.php");
 session_start();
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company Profile</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center">
   <h3>My Profile</h3>
   <table width="300" border="1">
   
     <?php
      $selQry = "select * from tbl_company c 
	  inner join tbl_place p on c.place_id = p.place_id 
	  inner join tbl_district d on p.district_id = d.district_id 
	  inner join tbl_state s on d.state_id = s.state_id 
	  where c.company_id='".$_SESSION['cid']."' "; 
	  $row=$Con->query($selQry);
	  $data=$row->fetch_assoc();
?>
   
   
   
  <tr>
    <td colspan="2" align="center">
     <img src="../Assets/Files/Company_Registration/Logo/<?php echo $data['company_logo']?>" width="150" height="150">
     </td>
  </tr>
  <tr>
     <td>Name</td>
    <td><?php echo $data['company_name'] ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $data['company_email'] ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo $data['company_address'] ?></td>
  </tr>
  
  <tr>
    <td>State</td>
    <td><?php echo $data['state_name'] ?></td>
  </tr>
  <tr>
    <td>District</td>
    <td><?php echo $data['district_name'] ?></td>
  </tr>
  <tr>
    <td>Place</td>
    <td><?php echo $data['place_name'] ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
     <a href="Editprofile.php">Edit Profile</a> |  <a href= "Changepass.php" >
     Change Password</a>

    </td>
    </tr>
</table>

   
  </div>
</form>
</body>
</html>