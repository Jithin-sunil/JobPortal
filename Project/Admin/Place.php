<?php
include("../Assets/Connection/Connection.php");
$placeid="";
$placename="";
 
		  if(isset($_POST['btn_submit']))
		  {
			$place=$_POST['txt_place'];
			$dis_id=$_POST['sel_dist'];
			$hidden=$_POST['txt_hidden'];
			
			if($hidden=="")
			{
			$insQry="insert into tbl_place(place_name,district_id) values('".$place."','".$dis_id."')";
			
			if($Con->query($insQry))   
            {
	        ?>
            <script>
	         alert("inserted");
	         window.location="Place.php";
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
	  $upQry="update tbl_place set place_name='".$place."', district_id='".$dis_id."',  place_status=0 where place_id='".$hidden."'";
	     if($Con->query($upQry))   
         {
	      //echo "inserted";
	      ?>
          <script>
	        alert("Updated");
	        window.location="Place.php";
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
 $remQry=" update tbl_place set place_status=1 where place_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Place.php";
	  </script> 	
      <?php
	
}

}
	  
 	   //edit
	   if(isset($_GET['edit_id']))
	   {
	    $selQry="select * from tbl_place where place_id='".$_GET['edit_id']."'";
	    $row=$Con->query($selQry);
	    $data=$row->fetch_assoc();
	
	    $placeid=$data['place_id'];
	    $placename=$data['place_name'];
          }

		  
	  		  
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
<div align="center">Place
</div>
  <table width="200" border="1" align="center">
    <tr>
      <td>State</td>
      <td align="center"><label for="sel_state"></label>
        <select name="sel_state" id="sel_state" onChange="getDistrict(this.value)">
          <option>-select state-</option>
          <?php
		   $selQry = "select * from tbl_state where state_status=0 ORDER BY state_name ASC";
		   $row=$Con->query($selQry);
		   while($data=$row->fetch_assoc())
		   {
		  ?>
          <option value="<?php echo $data['state_id']?>"><?php
		  echo $data['state_name']?></option>
          
          <?php
		   }
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>District</td>
      <td align="center"><label for="sel_dist"></label>
        <select name="sel_dist" id="sel_dist">
          <option>-select district-</option>
                   
                 
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $placeid ?>"/>
      <input type="text" name="txt_place" id="txt_place" value="<?php echo
	 $placename ?>"/>
     </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value= "Submit" />
        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
      </div></td>
    </tr>
  </table>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
  <div align="center">Place List
</div>
 <table width="200" border="1" align="center">
    <tr>
      <td>Sl.No</td>
      <td>State</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	  $i=0;
	  $selQry="select * from tbl_place p INNER JOIN tbl_district d on p.district_id = d.district_id inner join tbl_state s on d.state_id = s.state_id and place_status=0 ORDER BY place_name ASC";
	  $row=$Con->query($selQry);
	  while($data=$row->fetch_assoc())
	   {
		  $i++; 
	   
	?>
    <tr>
      
      <td><?php echo $i?></td>
      <td><?php echo $data['state_name']?></td>
      <td><?php echo $data['district_name']?></td>
      <td><?php echo $data['place_name']?></td>
      <td>
          <a href = "Place.php?rid=<?php echo $data['place_id']?>">remove</a>
          <a href = "Place.php?edit_id=<?php echo $data['place_id']?>">edit</a>
      </td>
    </tr>
    <?php
	 }
	?>  
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getDistrict(sid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
      success: function (result) {

        $("#sel_dist").html(result);
      }
    });
  }
</script>
