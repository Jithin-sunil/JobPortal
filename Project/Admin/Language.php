<?php
include("../Assets/Connection/Connection.php");
 $languageid = "";
 $languagename = "";
if(isset($_POST['btn_submit']))
{
  $language=$_POST['txt_language'];	
  $hidden=$_POST['txt_hidden'];
  
  if($hidden=="")
  {
  $insQry="insert into tbl_language(language_name) values('".$language."')";
    if($Con->query($insQry))  
	{
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Language.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Language.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_language set language_name = '". $language."' where language_id = '".$hidden."'";
   if($Con->query($upQry))
   {
	   ?>
         <script>
			  alert("Updated Successfully");
			  window.location="Language.php";
		    </script>
	      <?php
      }
	      else
	      {
		 ?>
        <script>
		alert("Error");
		window.location="Language.php";
		</script>
		<?php
		 }
	}
  } 
 
 
  //remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_language set language_status=1 where language_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="	Language.php";
	  </script> 	
      <?php
	
}

}
	  
 //edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_language where language_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $languageid = $data['language_id'];
		 $languagename = $data['language_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Language</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">Language </div>
      <table width="200" border="1"align="center">
      <tr>
        <td>Language</td>
        <td><label for="txt_language"></label>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php echo $languageid?>"/>
        <input type="text" name="txt_language" id="txt_language" value = "<?php echo $languagename?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
        </tr>
    </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div align="center">Language list </div><table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>language</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_language where language_status=0 ORDER BY language_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  ?>
  <tr>
    <td><?php echo  $i ?></td>
    <td><?php echo $data['language_name']?></td>
    <td>        
     <a href = "Language.php?rid=<?php echo $data['language_id']?>">remove</a>
     <a href = "Language.php?eid=<?php echo $data['language_id']?>">edit
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