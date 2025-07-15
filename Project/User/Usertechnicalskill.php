<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
  $skill_id=$_POST["sel_tskill"];
  
  $selQry= "select * from tbl_usertechnicalskill where technicalskill_id='".$_POST["sel_tskill"]."' and user_id='".$_SESSION['uid']."'";
 $row=$Con->query($selQry);
 if($data=$row->fetch_assoc())
 {
	   
     ?>
      <script>
	  alert("skill already exists");
	  window.location="Usertechnicalskill.php";
	  </script> 	
      <?php
	  
  }
  else
  {
  $insQry = "insert tbl_usertechnicalskill(technicalskill_id,user_id) values ('".$skill_id."','".$_SESSION['uid']."')";
  if($Con->query($insQry))
  {
	  ?>
      <script>
	  alert("Submitted Successfully");
	  window.location="Usertechnicalskill.php";
	  </script>
      <?php
   }
    else
    {
	  ?>
      <script>
	  alert("Wrong submitted");
	  window.location="Usertechnicalskill.php";
	  </script>
      <?php
   }
}
}

#remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_usertechnicalskill set usertechnicalskill_status=1 where usertechnicalskill_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Usertechnicalskill.php";
	  </script> 	
      <?php
	
}

}
 /*#edit
  if(isset($_GET['eid']))
	   {
	    $selQry="select * from tbl_usertechnicalskill where usertechnicalskill_id ='".$_GET['eid']."'";
	    $row=$Con->query($selQry);
	    $data=$row->fetch_assoc();
	
	    $tskillid=$data['usertechnicalskill_id'];
		
	     $sid=$data['technicalskill_id'];
		
          }
		*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Technical Skill</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center">
<h3>User Technical Skill</h3>
<table width="200" border="1">
  <tr>
    <td>Technical Skill</td>
    <td><label for="sel_tskill"></label>
      <select name="sel_tskill" id="sel_tskill">
        <option align= "center">-select-</option>
        <?php
		$selQry="select * from tbl_technicalskill where technicalskill_status=0";
		$row=$Con->query($selQry);
		   while($data=$row->fetch_assoc())
		   {
		 ?>
           <option value="<?php echo $data['technicalskill_id']?>"><?php
		  echo $data['technicalskill_name']?></option>
         
         
         <?php
          }	
		?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<div align="center">
<h3>List</h3>
<table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Technical Skill</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry=" select * from tbl_usertechnicalskill u inner join tbl_technicalskill t on u.technicalskill_id = t.technicalskill_id  where usertechnicalskill_status=0 and user_id='".$_SESSION['uid']."'";
   	$row=$Con->query($selQry);
	 while($data=$row->fetch_assoc())
	 {
		 
		 $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php  echo $data['technicalskill_name']?></td>
    <td>
    <a href = "Usertechnicalskill.php?rid=<?php echo $data['usertechnicalskill_id'] ?>">remove</a> 
    </td>
  </tr>
  
    <?php
	 }
	?>

</table>
</div>
</div>
</form>
</body>
</html>
