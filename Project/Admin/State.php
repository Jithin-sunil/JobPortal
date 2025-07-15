<?php
  include("../Assets/Connection/Connection.php");
  $stateid="";
  $statename="";
  if(isset($_POST['btn_submit']))
  {
	$state = $_POST['txt_state'];
    $hidden = $_POST['txt_hidden'];
   if($hidden=="")
   {
	$insQry = "insert into tbl_state(state_name)values('".$state."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Insertion Successfully");
		window.location="State.php";
		</script>
        <?php
		
	}
	else
	{
		?>
        <script>
		alert("Error");
		window.location="State.php";
		</script>
        <?php
	}
   }
   else
    {
		$upQry = "update tbl_state set state_name =  '".$state."' where state_id = '".$hidden."' ";
		if($Con->query($upQry))
		 {
			 ?>
             
            <script>
			  alert("Updated Successfully");
			  window.location="State.php";

		    </script>
            <?php
		  }
	      else
	      {
		 ?>
        <script>
		alert("Error");
		window.location="State.php";
		</script>
		<?php
		 }
	}
  }
	  //remove
	  if(isset($_GET['rid']))
	  {
		$remQry="update tbl_state set state_status=1 where state_id='".$_GET['rid']."'";  
		if($Con->query($remQry))
		 {
			 ?>
             
            <script>
			  alert("Removed");
			  window.location="State.php";

		    </script>
            <?php
		  }
	  }
	  
	  
	  
	  
	  //edit
	  if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_state where state_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $stateid = $data['state_id'];
		 $statename = $data['state_name'];
		 
	  }
	  ?>

		  
    
    
    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>State</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<p align= "center">State</p>
    <table width="200" border="1" align="center">
      <tr>
        <td>State</td>
        <td><label for="txt_state"></label>    
        
            <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $stateid?>" />
            <input type="text" name="txt_state" id="txt_state" value="<?php echo $statename?>" />
            </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><div align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value= "Submit" />
      </tr>
    </table>
    <p>&nbsp;</p>
    <p align= "center">State list</p>

    <div align="center">
      <table width="200" border="1">
        <tr>
          <td>Sl.No</td>
          <td>State</td>
          <td>Action</td>
        </tr>
        
        <?php
		$i=0;
		$selQry="select * from tbl_state where state_status=0 order by state_name ASC";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			$i++;	
		?>
        
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data['state_name']?></td>
          <td>
          
          <a href = "State.php?rid=<?php echo $data['state_id']?>">remove</a>
          <a href = "State.php?eid=<?php echo $data['state_id']?>">edit</a>

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