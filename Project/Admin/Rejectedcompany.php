<?php
  include("../Assets/Connection/Connection.php");
  
   //accept
  if(isset($_GET['aid']))
  {
   $upQry = "update tbl_company set company_status = 1 where company_id = '".$_GET['aid']."' ";
   if($Con->query($upQry))
   {
	?>   
	   <script>
	         alert("Accepted");
	         window.location="Rejectedcompany.php";
	        </script>
  
  <?php
   }
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rejected Company</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<h3 align="center">Rejected Company</h3>
  <table width="200" border="1" align="center">
    <tr>
      <td>Sl.No</td>
      <td>Name</td>
      <td>Email</td>
      <td>Contact</td>
      <td>Address</td>
      <td>Logo</td>
      <td>License</td>
      <td>State</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>

    </tr>
    <?php
     $i=0;
	 $selQry="select * from tbl_company c inner join tbl_place p on c.place_id = p.place_id inner join tbl_district d on p.district_id = d.district_id inner join tbl_state s on d.state_id = s.state_id where company_status=2 ORDER BY company_name ASC ";
	 $row=$Con->query($selQry);
	 while($data=$row->fetch_assoc())
	 {
		 $i++;
		
    ?>
    <tr>
      <td><?php  echo $i?></td>
      <td><?php echo $data['company_name']?></td>
      <td><?php echo $data['company_email']?></td>
      <td><?php echo $data['company_contact']?></td>
      <td><?php echo $data['company_address']?></td>
      <td><?php echo $data['company_logo']?></td>
      <td><?php echo $data['company_license']?></td>
      <td><?php echo $data['state_name']?></td>
      <td><?php echo $data['district_name']?></td>
      <td><?php echo $data['place_name']?></td>
         <td>
         <a href = "Rejectedcompany.php?aid=<?php echo $data['company_id']?>">Accept</a>
         </td>

      <?php
	 } 
	 ?>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>