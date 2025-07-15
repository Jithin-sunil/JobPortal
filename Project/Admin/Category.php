<?php
include("../Assets/Connection/Connection.php");
$Categoryid="";
$Categoryname="";
if(isset($_POST['btn_submit']))
{
 $category=$_POST['txt_category'];
 $hidden=$_POST['txt_hidden'];
 
  if($hidden=="")
  {
 
 $insQry="insert into tbl_category(category_name)values('".$category."')";
 
 if($Con->query($insQry))
	 {
		 ?>
         <script>
		 alert("Category inserted Successfully!!");
		 window.location="Category.php";
		 </script>
         <?php
	 }else{
		 ?>
          <script>
		 alert("insertion FAILED!!");
		 window.location="Category.php";
		 </script>
         
	     <?php
 }
}else{
	 
	$upQry="update tbl_category set category_name='".$category."' where category_id='".$hidden."'";
	
 if($Con->query($upQry))
	 {
		 ?>
         <script>
		 alert("Category Updated Successfully!!");
		 window.location="Category.php";
		 </script>
         <?php
	 }else{
		 ?>
          <script>
		 alert("UPDATION FAILED!!");
		 window.location="Category.php";
		 </script>
         
	     <?php
 }
 }
}
 
 
 
 
  //remove
	  if(isset($_GET['rid']))
	  {
		$remQry="update tbl_category set category_status=1 where category_id='".$_GET['rid']."'";  
		if($Con->query($remQry))
		 {
			 ?>
             
            <script>
			  alert("Removed");
			  window.location="Category.php";

		    </script>
            <?php
		  }
	  }

 
 //edit
 
 
  if(isset($_GET['eid']))
    {
		$selQry="select * from tbl_category where category_id='".$_GET['eid']."'";
		$row=$Con->query($selQry);
		$data=$row->fetch_assoc();
		
		$Categoryid=$data['category_id'];
		$Categoryname=$data['category_name'];

		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Category</title>
</head>

<body>
<div align="center">Job Category
</div>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td>Category Name</td>
      <td><label for="txt_category"></label>
       <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $Categoryid ?>"/>
      <input type="text" name="txt_category" id="txt_category" value="<?php echo $Categoryname ?>"/>
      </td>
      
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  
  <div align="center">Job Category List
   </div>
  <table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>Category</td>
    <td>Action</td>
  </tr>
  <?php
    $i=0;
    $selectQry="select * from tbl_category where category_status=0 ORDER BY category_name ASC";
	$row=$Con->query($selectQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	
  
  ?> 
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['category_name'] ?></td>
    <td>
    <a href="Category.php?rid=<?php echo $data['category_id'] ?>">remove</a>
    <a href="Category.php?eid=<?php echo $data['category_id'] ?>">edit</a>
    </td>
    
    
  </tr> 
  <?php
  }

  ?>

</table>

</form>
</body>
</html>