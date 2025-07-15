<?php
 include("../Assets/Connection/Connection.php");
 $questioncategoryid="";
 $questioncategoryname="";
 if(isset($_POST['btn_submit']))
{
 $quescategory=$_POST['txt_quescategory'];
 $mark=$_POST['txt_mark'];
 $time=$_POST['txt_time'];
 $hidden=$_POST['txt_hidden'];
 
 if($hidden=="")
 {
 
 $insQry="insert into tbl_questioncategory(questioncategory_name,questiocategory_time,questioncategory_mark)values('".$quescategory."'.'".$time."','".$mark."')";
 
 
 if($Con->query($insQry))
	 {
		 ?>
<script>
  alert("insertion Successfully");
  window.location = "Questioncategory.php";
</script>
<?php
	 }
	 else
	 {
		 ?>
<script>
  alert("insertion FAILED");
  window.location = "Questioncategory.php";
</script>

<?php
	 }
}
}
//remove
if(isset($_GET['rid']))
{
  $remQry = "update tbl_questioncategory set questioncategory_status = 1 where questioncategory_id = '".$_GET['rid']."' ";	
  if($Con->query($remQry))
		 {
			 ?>

<script>
  alert("Removed");
  window.location = "Questioncategory.php";

</script>
<?php
		  }
	  }
	  	
	
  //edit
	  if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_questioncategory where questioncategory_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $questioncategoryid = $data['questioncategory_id'];
		 $questioncategoryname = $data['questioncategory_name'];
		 
	  }
	  ?>


<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Question category</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <div align="center">
      <h3>Question Category</h3>

      <table width="200" border="1" align="center">
        <tr>
          <td>Question Category</td>
          <td><label for="txt_quescategory"></label>
            <div align="center">
              <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $questioncategoryid ?>" />

              <input type="text" name="txt_quescategory" id="txt_quescategory"
                value="<?php echo $questioncategoryname ?>" />
            </div>
          </td>
          
        </tr>
        <tr>
          <td>Mark</td>
          <td>
            <div align="center">
              <input type="text" name="txt_mark" id="txt_mark" value="<?php echo $data['questioncategory_mark'] ?>" />
            </div>
          </td>
        </tr>
        <tr>
          <td>Time</td>
          <td>
            <div align="center">
              <input type="text" name="txt_time" id="txt_time"
                value="<?php echo $data['questiocategory_time'] ?>" />
            </div>
          </td>
        
        <tr>
          <td colspan="2">
            <div align="center">
              <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
              <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
            </div>
          </td>
        </tr>
      </table>

      <p>&nbsp;</p>
      <h3>Question Category List</h3>

      <table width="250" border="1">
        <tr>
          <td>Sl.No</td>
          <td> Category Name</td>
          <td>Action</td>
        </tr>
        <tr>
          <?php
		$i=0;
		$selQry="select * from tbl_questioncategory where questioncategory_status=0 order by questioncategory_name ASC";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			$i++;	
		?>

        <tr>
          <td>
            <?php echo $i?>
          </td>
          <td>
            <?php echo $data['questioncategory_name']?>
          </td>
          <td>

            <a href="Questioncategory.php?rid=<?php echo $data['questioncategory_id']?>">remove</a>
            <a href="Questioncategory.php?eid=<?php echo $data['questioncategory_id']?>">edit</a>

          </td>

          <?php
	 	  }
		  ?>
        </tr>
      </table>
    </div>
  </form>
</body>

</html>