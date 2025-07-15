<?php
  include("../Assets/Connection/Connection.php");
  	$adminid = "";
	$adminname = "";
	$adminemail = "";
	$adminpassword = "";
  if(isset($_POST['btn_submit']))
  {
	  $name=$_POST['txt_name'];
	  $email=$_POST['txt_email'];
	  $pass=$_POST['txt_pass'];
	  $hidden=$_POST['txt_hidden'];
	  
	  if($hidden=="")
	  
	  {
	  
	  $insQry="insert into tbl_admin (admin_name, admin_email, admin_password) values('".$name."','". $email."','".$pass."')";  
  
           if($Con->query($insQry))
           {
            ?>
            <script>
              alert("Admin inserted Successfully!!");
	          window.location="AdminRegistration.php";
            </script>
            <?php
            }
	         else
	         {
	       ?>
           <script>
             alert(" insertation failed");
	         window.location="AdminRegistration.php";
           </script>
           <?php
         }
    }
     else
	 {
	  $upQry= "update tbl_admin set admin_name = '".$name."', admin_email = '".$email."', admin_password = '".$pass."' where admin_id='".$hidden."'";
	   if($Con->query($upQry))
	   {
		 ?>
         <script>
		   alert("AdminRegistration Updated Successfully!!");
	       window.location="AdminRegistration.php";
		 </script>
         <?php
	    }
		 else
		 {
		 ?>
          <script>
		    alert("UPDATION FAILED!!");
		    window.location="AdminRegistration.php";
		  </script>
         
          <?php
         }
       }
    }
  
  
  if(isset($_GET['did']))
  {
   $delQry="delete from tbl_admin where admin_id='".$_GET['did']."'";
   
  
     if($Con->query($delQry))
     {
      ?>
      <script>
		 alert("Row deleted Successfully!!");
		 window.location="AdminRegistration.php";
	  </script>
      <?php
	  }
	   else
	  {
	  ?>
         <script>
		   alert("DELETION FAILED!!");
		   window.location="AdminRegistration.php";
		 </script>
         
	     <?php
     }
   } 
 
   if(isset($_GET['eid']))
   {
	$selQry="select * from tbl_admin where admin_id='".$_GET['eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	$adminid = $data['admin_id'];
	$adminname = $data['admin_name'];
	$adminemail = $data['admin_email'];
	$adminpassword = $data['admin_password'];
   }
         ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
</head>

<body>
<div align="center">Admin Registration
</div>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $adminid ?>" />
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $adminname ?>" />
      </td>
    </tr>
    
    
    <tr>
      <td>E-mail</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" value="<?php echo $adminemail ?>"/>
      </td>
    </tr>
    
    
    <tr>
      <td>Password</td>
      <td><label for="txt_pass"></label>
      <input type="text" name="txt_pass" id="txt_pass" value="<?php echo $adminpassword ?>"/></td>
    </tr>
    
    
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value = "Submit" />
      </div></td>
    </tr>
  </table>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <div align="center">Admin Registration
 </div>
  <table width="200" border="1" align="center">
    <tr>
      <td>Sl.No</td>
      <td>Name</td>
      <td>E-mail</td>
      <td>Password</td>
      <td>Action</td>
    </tr>
    <?php
    $i=0;
    $selectQry="select * from tbl_admin";
	$row=$Con->query($selectQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	
  
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['admin_name'] ?></td>
      <td><?php echo $data['admin_email'] ?></td>
      <td><?php echo $data['admin_password'] ?></td>
      <td>
	    <a href = "AdminRegistration.php?did=<?php echo $data['admin_id']?>">delete</a>
   	    <a href = "AdminRegistration.php?eid=<?php echo $data['admin_id']?>">edit</a>
	 
      </td>
    </tr>
   <?php
   }
   ?>
  </table>
</form>
</body>
</html>