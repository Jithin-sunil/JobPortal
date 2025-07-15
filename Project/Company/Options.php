<?php
 include("../Assets/Connection/Connection.php");
 
 if(isset($_POST['btn_submit']))
 {
     $option = $_POST['txt_option'];
	 $answer = $_POST['rd_iscorrect'];
	 
	 $selOption="select * from tbl_option where option_iscorrect='1' and question_id='".$_GET['qid']."'";
	 $row=$Con->query($selOption);
	 if($row-> num_rows > 0)
	 {
		 $insQry = "insert into tbl_option(option_options,option_iscorrect,question_id)values('".$option."',0,'".$_GET['qid']."')";
	 
	 
			 if($Con->query($insQry))
			{
			?>
   			<script>
			alert("Insertion Successfully");
			</script>
		
	   		<?php	
			}
	 }
	 else
	 {
		 $insQry = "insert into tbl_option(option_options,option_iscorrect,question_id)values('".$option."','".$answer."','".$_GET['qid']."')";
	 
	 
			 if($Con->query($insQry))
			{
			?>
   			<script>
			alert("Insertion Successfully");
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
<title>options</title>
</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Option</td>
      <td><label for="txt_option"></label>
      <input type="text" name="txt_option" id="txt_option" /></td>
    </tr>
    <tr>
      <td>Answer </td>
      <td><input type="radio" name="rd_iscorrect" id="rd_iscorrect" value="1" />True
      <input type="radio" name="rd_iscorrect" id="rd_iscorrect" value="0" />False
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  </form>
  <p>&nbsp;</p>
  <div align="center">
  <table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Option</td>
    <td>Answer</td>
    <td>Action</td>

  </tr>
  <?php
  $selQry = "select * from tbl_option  ";
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</div>
</body>
</html>