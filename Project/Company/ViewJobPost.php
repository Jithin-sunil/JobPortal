<?php
  include("../Assets/Connection/Connection.php");
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table width="1000" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Title</td>
    <td>Content</td>
    <td>Experience</td>
    <td>Job Type</td>
    <td>Job Category</td>
    <td>Last Date</td>
    <td>Action</td>

  </tr>
  <?php
      $i=0;
      $selQry = "select * from tbl_jobpost p inner join tbl_jobtype t on p.jobtype_id = t.jobtype_id inner join tbl_category c on p.category_id = c.category_id where jobpost_status=0 ORDER BY jobpost_date ASC";
	   $row = $Con->query($selQry); 
	 while($data=$row->fetch_assoc())
	 {
		$i++; 
	    
  
  ?>
  <tr>
    <td><?php  echo $i?></td>
    <td><?php echo $data['jobpost_title']?></td>
    <td><?php echo $data['jobpost_content']?></td>
    <td><?php echo $data['jobpost_experience']?></td>
    <td><?php echo $data['jobtype_name']?></td>
    <td><?php echo $data['category_name']?></td>
    <td><?php echo $data['jobpost_lastdate']?></td>
   

     <td>
     <a href ="ViewResult.php?jid=<?php echo $data['jobpost_id']?>">View Result</a>
</td>
     <?php
     }
     ?>
  </tr>
</table>
</body>
</html>