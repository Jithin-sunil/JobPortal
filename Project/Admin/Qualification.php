<?php
include("../Assets/Connection/Connection.php");
 $qualificationid = "";
 $qualificationname = "";
if(isset($_POST['btn_submit']))
{
  $qualification=$_POST['txt_qualification'];	
  $hidden=$_POST['txt_hidden'];
  
  if($hidden=="")
  {
  $insQry="insert into tbl_qualification(qualification_name) values('".$qualification."')";
    if($Con->query($insQry))  
	{
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Qualification.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Qualification.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_qualification set qualification_name = '". $qualification."' where qualification_id = '".$hidden."'";
   if($Con->query($upQry))
   {
	   ?>
         <script>
			  alert("Updated Successfully");
			  window.location="Qualification.php";
		    </script>
	      <?php
      }
	      else
	      {
		 ?>
        <script>
		alert("Error");
		window.location="Qualification.php";
		</script>
		<?php
		 }
	}
  } 
 
	  //remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_qualification set qualification_status=1 where qualification_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="	Qualification.php";
	  </script> 	
      <?php
	
}

}
	  
 //edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_qualification where qualification_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $qualificationid = $data['qualification_id'];
		 $qualificationname = $data['qualification_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Qualification</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">Qualification </div>
      <table width="200" border="1"align="center">
      <tr>
        <td>Qualification</td>
        <td><label for="txt_qualification"></label>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php echo $qualificationid?>"/>
        <input type="text" name="txt_qualification" id="txt_qualification" placeholder="eg.BCA" value = "<?php echo $qualificationname?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
        </tr>
    </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div align="center">Qualification List </div><table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>qualification</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_qualification where qualification_status=0 ORDER BY qualification_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  ?>
  <tr>
    <td><?php echo  $i ?></td>
    <td><?php echo $data['qualification_name']?></td>
    <td>        
     <a href = "Qualification.php?rid=<?php echo $data['qualification_id']?>">remove</a>
     <a href = "Qualification.php?eid=<?php echo $data['qualification_id']?>">edit
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