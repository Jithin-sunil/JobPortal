<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$language_id=$_POST["sel_language"];
	
    $selQry="select * from tbl_userlanguage where language_id ='".$_POST["sel_language"]."' and user_id = '".$_SESSION['uid']."' ";
	 $row=$Con->query($selQry);
 if($data=$row->fetch_assoc())
 {
	   
     ?>
      <script>
	  alert("skill already exists");
	  window.location="Userlanguage.php";
	  </script> 	
      <?php
	  
  }
  else
  {
	
	$insQry="insert into tbl_userlanguage(language_id, user_id) values ('".$language_id."','".$_SESSION['uid']."')";
	 if($Con->query($insQry))
  {
	  ?>
<script>
	  alert("Submitted Successfully");
	  window.location="Userlanguage.php";
	  </script>
      <?php
   }
    else
    {
	  ?>
<script>
	  alert("Wrong submission");
	  window.location="Userlanguage.php";
	  </script>
      <?php
   }
 }
}
#remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_userlanguage set userlanguage_status=1 where userlanguage_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Userlanguage.php";
	  </script> 	
      <?php
	
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Language</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center"><h3>User Language</h3>
<table width="200" border="1">
  <tr>
    <td>Language</td>
    <td><label for="sel_language"></label>
      <select name="sel_language" id="sel_language">
        <option align= "center">-select-</option>
        <?php
		$selQry="select * from  tbl_language where language_status=0";
		$row=$Con->query($selQry);
		   while($data=$row->fetch_assoc())
		   {
		 ?>
           <option value="<?php echo $data['language_id']?>"><?php
		  echo $data['language_name']?></option>
         
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
<h3>List</h3>
<table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Language</td>
    <td>Action</td>
  </tr>
    <?php
   $i=0;
    $selQry="select * from tbl_userlanguage u
    inner join tbl_language t on u.language_id = t.language_id  
	where userlanguage_status=0 and user_id='".$_SESSION['uid']."'";
   	$row=$Con->query($selQry);
	 while($data=$row->fetch_assoc())
	 {
		 
		 $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data['language_name']?></td>
    <td>
    <a href  = "Userlanguage.php?rid=<?php echo $data['userlanguage_id'] ?>">remove</a>
    </td>
  </tr>
  <?php
	 }
  ?>
</table>



</div>
</form>
</body>
</html>
