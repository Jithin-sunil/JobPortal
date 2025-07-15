<?php
include("../Assets/Connection/Connection.php");
$companytypeid = "";
$companytypename = "";
if(isset($_POST['btn_submit']))
{
  $companytype=$_POST['txt_companytype'];
  $hidden = $_POST['txt_hidden'];
   
    if($hidden=="")
	{
  $insQry = "insert into tbl_companytype(companytype_name) values('".$companytype."')";	
  if($Con->query($insQry))
  {
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Companytype.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Companytype.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_companytype set companytype_name = '".$companytype."' where
   companytype_id = '".$hidden."' ";
   if($Con->query($upQry))
   { 
   ?>
    ?>
         <script>
			  alert("Updated Successfully");
			  window.location="Companytype.php";
		    </script>
	      <?php
   
    }
	 else
	  {
		 ?>
        <script>
		alert("Error");
		window.location="Companytype.php";
		</script>
		<?php
	 }
	}
  }

 //remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_companytype set companytype_status=1 where companytype_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Companytype.php";
	  </script> 	
      <?php
	
  }
}


//edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_companytype where companytype_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $companytypeid = $data['companytype_id'];
		 $companytypename = $data['companytype_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company Type</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center"><h3>Company Type </h3>
<table width="200" border="1">
  <tr>
    <td>Company Type</td>
    <td><label for="txt_companytype"></label>
     <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php  echo $companytypeid?>"/>
      <input type="text" name="txt_companytype" id="txt_companytype" value = "<?php  echo $companytypename?>"/>
    </td>
  </tr>
  <tr>
    <td height="26" colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit"/>
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<h3>Company Type List</h3>
<table width="200" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Company Type</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_companytype where companytype_status=0 ORDER BY
   companytype_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  
   
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['companytype_name']?></td>
    <td>
     <a href = "Companytype.php?rid=<?php echo $data['companytype_id']?>">remove
     </a>
     <a href = "Companytype.php?eid=<?php echo $data['companytype_id']?>">edit
     </a>
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