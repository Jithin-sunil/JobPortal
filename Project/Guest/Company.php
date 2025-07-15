<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
	
	$logo=$_FILES['file_logo']['name'];
	$templogo=$_FILES['file_logo']['tmp_name'];
	move_uploaded_file($templogo,'../Assets/Files/Company_Registration/Logo/'.$logo);
	
	$license=$_FILES['file_license']['name'];
	$templicense=$_FILES['file_license']['tmp_name'];
	move_uploaded_file($templicense,'../Assets/Files/Company_Registration/License/'.$license);
	
	$password=$_POST['txt_password'];
	$place=$_POST['sel_place'];
	$companytype=$_POST['sel_companytype'];
	
     $insQry = "insert into tbl_company(company_name, company_email,company_contact, company_address, company_logo, company_license, place_id,companytype_id, company_password) values('".$name."','".$email."','".$contact."','".$address."','".$logo."','".$license."','".$place."','".$companytype."','".$password."')";
	if($Con->query($insQry))
	{
		?>
		<script>
		alert("Insertion Successfully");
		window.location="Company.php";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Company.php";
		</script> 
			<?php 
	 }
 }
 

 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <h3 align="center">Company</h3>
    <table width="200" border="1" align="center">
      <tr>
        <td>Name</td>
        <td><label for="txt_name"></label>
        <input type="text" name="txt_name" id="txt_name" minlength="3" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required/></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><label for="txt_email"></label>
        <input type="email" name="txt_email" id="txt_email" /></td>
      </tr>
      <tr>
        <td>Contact</td>
        <td><label for="txt_contact"></label>
        <input type="contact" name="txt_contact" id="txt_contact" /></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><label for="txt_address"></label>
          <textarea  name="txt_address" id="txt_address" rows="6"> </textarea></td>
      </tr>
      <tr>
        <td>Logo</td>
        <td><label for="file_logo"></label>
        <input type="file" name="file_logo" id="file_logo" /></td>
      </tr>
      <tr>
        <td>license</td>
        <td><label for="file_license"></label>
        <input type="file" name="file_license" id="file_license" /></td>
      </tr>
      <tr>
        <td>State</td>
        <td><label for="sel_state"></label>
          <div align="center">
            <select name="sel_state" id="sel_state" onChange="getDistrict(this.value)">
              <option>-select state-</option>
              <?php
			   $selQry="select * from tbl_state where state_status=0 ORDER BY state_name ASC";
			   $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>
			  <option value ="<?php echo $data['state_id']?>"><?php echo $data['state_name']?></option>
              
			  <?php
			   }
              ?>
            </select>
        </div></td>
      </tr>
      <tr>
        <td>District</td>
        <td><label for="sel_district"></label>
          <div align="center">
            <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
              <option>-select District-</option>
            </select>
        </div></td>
      </tr>
      
      <tr>
        <td>Place</td>
           <td><label for="sel_place"></label>
           <div align="center">
            <select name="sel_place" id="sel_place">
              <option>-select place-</option>
            </select>
        </div></td>
      </tr>
      <tr>
        <td>Company Type</td>
        <td><label for="sel_companytype"></label>
          <div align="center">
            <select name="sel_companytype" id="sel_companytype">
              <option>-select company type-</option>
                <?php
			   $selQry="select * from tbl_companytype where companytype_status=0 ORDER BY  companytype_name ASC";
			   $row=$Con->query($selQry);
			   while($data=$row->fetch_assoc())
			   {
			    ?>              
			  <option value ="<?php echo $data['companytype_id']?>"><?php echo $data['companytype_name']?></option>
              
			  <?php
			   }
              ?>
                
            </select>
        </div></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><label for="txt_password"></label>
        <input type="password" name="txt_password" id="txt_password" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
      </tr>
    </table>

</form>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getDistrict(sid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
      success: function (result) {

        $("#sel_district").html(result);
      }
    });
  }
  
  function getPlace(pid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?pid=" + pid,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }
</script>
