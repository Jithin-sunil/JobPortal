<?php
 include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View more</title>
</head>

<body>
<div align="center">
<h3>Job Details</h3>
<table width="300" border="1">
<?php
  $selQry = "select * from tbl_jobpost p 
  inner join tbl_jobtype t on p.jobtype_id  = t.jobtype_id 
  inner join tbl_category c on p.category_id   = c.category_id  
  where jobpost_id = '".$_GET['eid']."'
  ";
  $row=$Con->query($selQry);
  $data=$row->fetch_assoc();
  
?>
  <tr>
    <td>Title</td>
    <td><?php echo $data['jobpost_title'] ?></td>
  </tr>
  <tr>
    <td>Content</td>
    <td><?php echo $data['jobpost_content'] ?></td>
  </tr>
  <tr>
    <td>Type</td>
    <td><?php echo $data['jobtype_name'] ?></td>
  </tr>
  <tr>
    <td>Category</td>
    <td><?php echo $data['category_name'] ?></td>
  </tr>
  <tr>
    <td>Experience</td>
    <td><?php echo $data['jobpost_experience'] ?></td>
  </tr>
  <tr>
    <td>Last Date</td>
    <td><?php echo $data['jobpost_lastdate'] ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>Company Details</h3>
<table width="300" border="1">
<?php
  
   $selQry1 = "select * from tbl_company c 
  inner join tbl_companytype t on c.companytype_id = t.companytype_id where c.company_id = '".$data['company_id']."' ";
  $row1=$Con->query($selQry1);
  $data1=$row1->fetch_assoc();

?>
  <tr>
    <td>Company Name</td>
    <td><?php echo $data1['company_name'] ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $data1['company_email'] ?></td>
  </tr>
  <tr>
    <td>Contact</td>
    <td><?php echo $data1['company_contact'] ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo $data1['company_address'] ?></td>
  </tr>
  <tr>
    <td>Logo</td>
    <td><?php echo $data1['company_logo'] ?></td>
  </tr>
  <tr>
    <td>Type</td>
    <td><?php echo $data1['companytype_name'] ?></td>
  </tr>
</table>


</div>
</body>
</html>