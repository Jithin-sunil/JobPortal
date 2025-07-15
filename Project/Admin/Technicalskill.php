<?php
include("../Assets/Connection/Connection.php");
 $technicalskillid = "";
 $technicalskillname = "";
if(isset($_POST['btn_submit']))
{
  $technicalskill=$_POST['txt_technicalskill'];	
  $hidden=$_POST['txt_hidden'];
  
  if($hidden=="")
  {
  $insQry="insert into tbl_technicalskill(technicalskill_name) values('".$technicalskill."')";
    if($Con->query($insQry))  
	{
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Technicalskill.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Technicalskill.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_technicalskill set technicalskill_name = '". $technicalskill."' where technicalskill_id = '".$hidden."'";
   if($Con->query($upQry))
   {
	   ?>
         <script>
			  alert("Updated Successfully");
			  window.location="technicalskill.php";
		    </script>
	      <?php
      }
	      else
	      {
		 ?>
        <script>
		alert("Error");
		window.location="Technicalskill.php";
		</script>
		<?php
		 }
	}
  } 
 
  //remove
	  if(isset($_GET['rid']))
	  {
		$remQry="update tbl_technicalskill set technicalskill_status=1 where technicalskill_id='".$_GET['rid']."'";  
		if($Con->query($remQry))
		 {
			 ?>
             
            <script>
			  alert("Removed");
			  window.location="Technicalskill.php";

		    </script>
            <?php
		  }
	  }
	  
 //edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_technicalskill where technicalskill_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $technicalskillid = $data['technicalskill_id'];
		 $technicalskillname = $data['technicalskill_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Technical Skill</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">Technical Skill</div>
      <table width="200" border="1"align="center">
      <tr>
        <td>Technical Skill</td>
        <td><label for="txt_technicalskill"></label>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php echo $technicalskillid?>"/>
        <input type="text" name="txt_technicalskill" id="txt_technicalskill" value = "<?php echo $technicalskillname?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
        </tr>
    </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div align="center">Technical Skill List </div><table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>Technical Skill</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_technicalskill where technicalskill_status=0  ORDER BY technicalskill_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  ?>
  <tr>
    <td><?php echo  $i ?></td>
    <td><?php echo $data['technicalskill_name']?></td>
    <td>        
     <a href = "Technicalskill.php?rid=<?php echo $data['technicalskill_id']?>">remove</a>
     <a href = "Technicalskill.php?eid=<?php echo $data['technicalskill_id']?>">edit</a>
    </td>
    
    
  </tr>
  <?php
   }
  ?>
</table>

      

</form>
</body>
</html>