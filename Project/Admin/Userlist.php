<?php
  include("../Assets/Connection/Connection.php");
  
  
 //remove
  if(isset($_GET['rid']))
  {
   $upQry = "update tbl_user set user_status = 1 where user_id = '".$_GET['rid']."' ";
   if($Con->query($upQry))
   {
	?>   
	   <script>
	         alert("Removed");
	         window.location="Userlist.php";
	        </script>
  
  <?php
   }
  }
?>
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User List</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <p>User List</p>
    <table width="200" border="1">
      <tr>
        <td>Sl No</td>
        <td>Name</td>
        <td>Email</td>
        <td>Contact</td>
        <td>Address</td>
        <td>Photo</td>
        <td>Gender</td>
        <td>DOB</td>
        <td>State</td>
        <td>District</td>
        <td>Place</td>
        <td>Action</td>
      </tr>
      <?php
	  $i=0;
       $selQry = "select * from tbl_user u inner join tbl_place p on u.place_id = p.place_id inner join tbl_district d on p.district_id = d.district_id inner join tbl_state s on d.state_id = s.state_id ORDER BY user_name ASC";
	   $row = $Con->query($selQry); 
	 while($data=$row->fetch_assoc())
	 {
		$i++; 
	    
	   ?>
      <tr>
        <td><?php  echo $i?></td>
        <td><?php echo $data['user_name']?></td>
        <td><?php echo $data['user_email']?></td>
        <td><?php echo $data['user_contact']?></td>
        <td><?php echo $data['user_address']?></td>
        <td><?php echo $data['user_photo']?></td>
        <td><?php echo $data['user_gender']?></td>
        <td><?php echo $data['user_dob']?></td>
        <td><?php echo $data['state_name']?></td>
        <td><?php echo $data['district_name']?></td>
        <td><?php echo $data['place_name']?></td>
        <td>
          <?php 
		 if($data['user_status']==0)
		 {
		 ?>
         <a href = "Userlist.php?rid=<?php echo $data['user_id']?>">Remove</a>

         <?php
		   }
	        elseif($data['user_status']==1)
		    {
			 echo "Removed";
			
		    }
		  else
		  {
			  echo "Temporary Unavilable";
		  }	
			
			?>
          
          
        </td>
        <?php
		 
	   }
		?>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
</form>
</body>
</html>