<?php
include("../Assets/Connection/Connection.php");
 $jobtypeid = "";
 $jobtypename = "";
if(isset($_POST['btn_submit']))
{
  $jobtype=$_POST['txt_jobtype'];	
  $hidden=$_POST['txt_hidden'];
  
  if($hidden=="")
  {
  $insQry="insert into tbl_jobtype(jobtype_name) values('".$jobtype."')";
    if($Con->query($insQry))  
	{
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Jobtype.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Jobtype.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_jobtype set jobtype_name = '". $jobtype."' where jobtype_id = '".$hidden."'";
   if($Con->query($upQry))
   {
	   ?>
         <script>
			  alert("Updated Successfully");
			  window.location="Jobtype.php";
		    </script>
	      <?php
      }
	      else
	      {
		 ?>
        <script>
		alert("Error");
		window.location="Jobtype.php";
		</script>
		<?php
		 }
	}
  } 
 
 //remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_jobtype set jobtype_status=1 where jobtype_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Jobtype.php";
	  </script> 	
      <?php
	
}

}
	  
 //edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_jobtype where jobtype_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $jobtypeid = $data['jobtype_id'];
		 $jobtypename = $data['jobtype_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobtype</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">Jobtype </div>
      <table width="200" border="1"align="center">
      <tr>
        <td>Job Type</td>
        <td><label for="txt_jobtype"></label>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php echo $jobtypeid?>"/>
        <input type="text" name="txt_jobtype" id="txt_jobtype" value = "<?php echo $jobtypename?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
        </tr>
    </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div align="center">Jobtype List </div><table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>Job Type</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_jobtype where jobtype_status=0 ORDER BY jobtype_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  ?>
  <tr>
    <td><?php echo  $i ?></td>
    <td><?php echo $data['jobtype_name']?></td>
    <td>        
     <a href = "Jobtype.php?rid=<?php echo $data['jobtype_id']?>">remove
     </a>
     <a href = "Jobtype.php?eid=<?php echo $data['jobtype_id']?>">edit
     </a>
    </td>
    
    
  </tr>
  <?php
   }
  ?>
</table>

      

</form>
</body>
</html>