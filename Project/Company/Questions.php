<?php
 include("../Assets/Connection/Connection.php");
 session_start();
 if(isset($_POST['btn_submit']))
 {
	 $quescategory = $_POST['sel_category'];
	 $question = $_POST['txt_question'];
	 $photo=$_FILES['file_photo'] ['name'];
	 if($photo != "")
	 {
	 $photo=$_FILES['file_photo'] ['name'];
   $tempphoto=$_FILES['file_photo'] ['tmp_name'];
   move_uploaded_file($tempphoto,'../Assets/Files/Questions/Photo/'.$photo);
   
   
   
   $insQry = "insert into tbl_question(question_title,question_file,questioncategory_id,exam_id)values('".$question."','".$photo."','".$quescategory."','".$_GET['eid']."')";
    if($Con->query($insQry))
	{
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Questions.php?eid=<?php echo $_GET['eid'] ?>";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Questions.php";
		</script> 
			<?php 
	 }
	 }
	 else
	 {
		    $insQry = "insert into tbl_question(question_title,questioncategory_id,exam_id)values('".$question."','".$quescategory."','".$_GET['eid']."')";
			 if($Con->query($insQry))
	{
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="Questions.php?eid=<?php echo $_GET['eid'] ?>";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Questions.php";
		</script> 
			<?php 
	 }
		 
	 }
   
   
 }

  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Questions</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div align="center">
    <table width="200" border="1">
      <tr>
        <td>Category</td>
        <td><label for="sel_category"></label>
          <select name="sel_category" id="sel_category">
            <option>--Select--</option>
            <?php
				$i=0;
		$selQry="select * from tbl_questioncategory where questioncategory_status=0 order by questioncategory_name ASC";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value="<?php echo $data['questioncategory_id']?>"><?php echo $data['questioncategory_name']?></option>
            <?php
		}
		?>
                    </select></td>
      </tr>
      <tr>
        <td>Question</td>
        <td><label for="txt_question"></label>
        <input type="text" name="txt_question" id="txt_question" /></td>
      </tr>
      <tr>
        <td>File</td>
        <td><label for="file_photo"></label>
        <input type="file" name="file_photo" id="file_photo" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<div align="center">
  <table width="200" border="1">
    <tr>
      <td>SI.No</td>
      <td>Category</td>
      <td>Question</td>
      <td>File</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
    $selQry = "select * from tbl_question q inner join tbl_questioncategory qc on q.questioncategory_id=qc.questioncategory_id  where exam_id ='".$_GET['eid']."' ";
	$result = $Con->query($selQry);
	while($row= $result ->fetch_assoc())
	{
	 	
	  $i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row['questioncategory_name']?></td>
      <td><?php echo $row['question_title']?></td>
      <td><?php if($row['question_file'] == "")
	  {
		  echo "No File";
	  }
	  else
	  {
		  ?>
        <img src="../Assets/Files/Questions/Photo/<?php echo $row["question_file"]; ?>" width="100" height="100" />
          <?php
		  
	  }?>
      </td>
      <td><a href="Options.php?qid=<?php echo $row['question_id'];?>">Add Option</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</div>
<p>&nbsp;</p>
</body>
</html>