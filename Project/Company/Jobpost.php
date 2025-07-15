<?php
 include("../Assets/Connection/Connection.php");
 session_start();
 if(isset($_POST['btn_submit']))
  {
   $title=$_POST['txt_title'];
   $content=$_POST['txt_content'];
   $experience=$_POST['txt_experience'];
   $lastdate=$_POST['txt_lastdate'];
   
   
   $jobtype=$_POST['sel_jobtype'];
   $jobcategory=$_POST['sel_jobcategory'];
   
   $insQry ="insert into  tbl_jobpost(jobpost_title, jobpost_content, jobpost_experience, jobtype_id, category_id, jobpost_lastdate, jobpost_date,company_id) values ('".$title."','".$content."','".$experience."','".$jobtype."','".$jobcategory."','".$lastdate."',curdate(),'".$_SESSION['cid']."') ";
   
 if($Con->query($insQry))
	{
		?>
<script>
  alert("Insertion Successfully");
  window.location = "Jobpost.php";
</script>

<?php	
	}
     else
	 {
		  ?>
<script>
  alert("Insertion Failed");
  window.location = "Jobpost.php";
</script>
<?php 
	 }
 }



  
 //remove
  if(isset($_GET['rid']))
  {
   $upQry = "update tbl_jobpost set jobpost_status = 1 where jobpost_id = '".$_GET['rid']."' ";
   if($Con->query($upQry))
   {
	?>
<script>
  alert("Removed");
  window.location = "Jobpost.php";
</script>

<?php
   }
  }
?>



<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Job Post</title>
</head>

<body>
  <div align="center">
    <h3>Job Post</h3>
    <form action="" method="post">
      <table width="300" border="1">
        <tr>
          <td>Title</td>
          <td><label for="txt_title"></label>
            <input type="text" name="txt_title" id="txt_title" />
          </td>
        </tr>
        <tr>
          <td>Content</td>
          <td><label for="txt_content"></label>
            <label for="txt_content"></label>
            <textarea name="txt_content" id="txt_content" cols="45" rows="5"></textarea>
        </tr>
        <tr>
          <td>Experience</td>
          <td><label for="txt_experience"></label>
            <input type="text" name="txt_experience" id="txt_experience" />
          </td>
        </tr>
        <tr>
          <td>Job Type</td>
          <td><label for="sel_jobtype"></label>
            <select name="sel_jobtype" id="sel_jobtype">
              <option>-select-</option>
              <?php
		 $selQry="select * from tbl_jobtype where jobtype_status=0 ORDER BY jobtype_name ASC";
	     $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
              <option value="<?php echo $data['jobtype_id']?>">
                <?php echo $data['jobtype_name']?>
              </option>

              <?php
			   }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Job Category</td>
          <td><label for="sel_jobcategory"></label>
            <select name="sel_jobcategory" id="sel_jobcategory">
              <option>-select-</option>
              <?php
		 $selQry="select * from tbl_category where category_status=0 ORDER BY category_name ASC";
	     $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
              <option value="<?php echo $data['category_id']?>">
                <?php echo $data['category_name']?>
              </option>

              <?php
			   }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Last Date</td>
          <td><label for="txt_lastdate"></label>
            <input type="date" name="txt_lastdate" id="txt_lastdate" />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <div align="center">
              <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <h3>Job Post List</h3>
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
          <td>Exam</td>

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
          <td>
            <?php  echo $i?>
          </td>
          <td>
            <?php echo $data['jobpost_title']?>
          </td>
          <td>
            <?php echo $data['jobpost_content']?>
          </td>
          <td>
            <?php echo $data['jobpost_experience']?>
          </td>
          <td>
            <?php echo $data['jobtype_name']?>
          </td>
          <td>
            <?php echo $data['category_name']?>
          </td>
          <td>
            <?php echo $data['jobpost_lastdate']?>
          </td>
          <td>
            <a href="Jobpost.php?rid=<?php echo $data['jobpost_id']?>">Remove</a><br />
            <a href="Jobqualification.php?pid=<?php echo $data['jobpost_id']?>">Add Qualification</a><br />
            <a href="Joblanguage.php?lid=<?php echo $data['jobpost_id']?>">Add Language</a><br />
            <a href="Jobtechnicalskill.php?tid=<?php echo $data['jobpost_id']?>">Add Technical skill</a><br />

          </td>

          <td>
            <a href="Exam.php?eid=<?php echo $data['jobpost_id']?>">Add Exam</a>
            
          </td>
          <?php
     }
     ?>
        </tr>
      </table>

    </form>
  </div>
</body>

</html>