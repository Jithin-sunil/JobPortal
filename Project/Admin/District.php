<?php
include("../Assets/Connection/Connection.php");
$districtname="";
$districtid="";
$sid="";
if(isset($_POST["btn_submit"]))
{
  $district=$_POST["txt_dist_name"];
  $state_id=$_POST['sel_state'];

  $hid=$_POST['txt_hidden'];
  
  if($hid=="")
  {
  $insQry="insert into tbl_district(state_id,district_name)values('".$state_id."','".$district."')";
  if($Con->query($insQry))   
  {
	  //echo "inserted";
	  ?>
      <script>
	  alert("insertion Successfully");
	  window.location="District.php";
	  </script>
      <?php
  }
  else
  {
	  echo "error";
  }
  }
  else
  {
	  $upQry="update tbl_district set district_name='".$district."',state_id = '".$state_id."' where district_id='".$hid."'";
	  if($Con->query($upQry))   
  {
	  //echo "inserted";
	  ?>
      <script>
	  alert("Updation Successfully");
	  window.location="District.php";
	  </script>
      <?php
  }
  else
  {
	  echo "error";
  }
  }

}


//remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_district set district_status=1 where district_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="District.php";
	  </script> 	
      <?php
	
}

}



//edit


if(isset($_GET['edit_id']))
{
	$selQry="select * from tbl_district where district_id='".$_GET['edit_id']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	$districtid=$data['district_id'];
	$sid=$data['state_id'];
	$districtname=$data['district_name'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>
<div align="center">District
</div>
<form action="" method="post">
  <table width="200" border="1" align="center">
    <tr>
      <td>State</td>
      <td><label for="sel_state"></label>
        <div align="center">
          <select name="sel_state" id="sel_state">
            <option>-select state-</option>
            <?php
			$selQry="select * from tbl_state where state_status=0 order by state_name ASC";
			$row=$Con->query($selQry);
			while($data=$row->fetch_assoc())
			{
			 ?>
             <option 
             <?php
             if($sid == $data['state_id'])
			 {
				 echo "selected";
			 }
			 ?>
               value="<?php echo $data['state_id']?>"><?php echo $data['state_name']?>	</option>	
             <?php		 	
			}
			
			?>
            
            
            
          </select>
      </div></td>
    </tr>
    <tr>
      <td>District </td>
      <td><label for="txt_dist_name"></label>
      <input type="hidden" name="txt_hidden" value="<?php echo $districtid ?>" />
      <input type="text" name="txt_dist_name" id="txt_dist_name" placeholder="Enter District Name" value="<?php echo $districtname ?>"/>
      </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value=         "Submit" />
        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <div align="center">District List
</div>
 <table width="200" border="1" align="center">
  <tr>
    <td>Sl.No</td>
    <td>State</td>
    <td>District</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $selQry="select * from tbl_district p inner join tbl_state d on p.state_id = d.state_id and district_status=0 ORDER BY district_name ASC";
  $row=$Con->query($selQry);
  while($data=$row->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data['state_name']?></td>
    <td><?php echo $data['district_name']?></td>
    <td>
    <a href = "District.php?rid=<?php echo $data['district_id'] ?>">remove</a>
    <a href = "District.php?edit_id=<?php echo $data['district_id'] ?>">edit</a>
    
    </td>

  </tr>
  <?php
  }
  ?>
</table>

</form>
</body>
</html>


