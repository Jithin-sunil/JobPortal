<?php
 include("../Assets/Connection/Connection.php");
 if(isset($_POST['btn_submit']))
 {
   $name=$_POST['txt_name'];
   $email=$_POST['txt_email'];
   $contact=$_POST['txt_contact'];
   $address=$_POST['txt_address'];
   
   $photo=$_FILES['file_photo'] ['name'];
   $tempphoto=$_FILES['file_photo'] ['tmp_name'];
   move_uploaded_file($tempphoto,'../Assets/Files/User_Registration/Photo/'.$photo);

   
   $gender=$_POST['rad_gender'];
   $dob=$_POST['dob_date'];
   $password=$_POST['txt_place'];
   $place=$_POST['sel_place'];
   
   
   $insQry="insert into tbl_user(user_name, user_email, user_contact, user_address, user_photo, user_gender, user_dob, place_id, user_password)values('".$name."','".$email."','".$contact."','".$address."','".$photo."','".$gender."','".$dob."','".$place."','".$password."')";
    
	if($Con->query($insQry))
	{
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="UserRegistration.php";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="UserRegistration.php";
		</script> 
			<?php 
	 }
 }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UserRegistration</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h3 align="center">User Registration </h3>
  <div align="center">
    <table width="200" border="1">
      <tr>
        <td>Name</td>
        <td><label for="txt_name"></label>
        <input type="text" name="txt_name" id="txt_name" minlength="3" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required/></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><label for="txt_email"></label>
        <input type="email" name="txt_email" id="txt_email"  required="required"/></td>
      </tr>
      <tr>
        <td>Contact</td>
        <td><label for="txt_contact"></label>
        <input type="text" name="txt_contact" id="txt_contact" maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaing 9 digit with 0-9" required="required"/> </td>
      </tr>
      <tr>
        <td>Address</td>
        <td><label for="txt_address"></label>
        <textarea name="txt_address" id="txt_address" cols="45" rows="5" required="required"></textarea></td>
      </tr>
      <tr>
        <td>Photo</td>
        <td><label for="file_photo"></label>
        <input type="file" name="file_photo" id="file_photo" required="required" accept="image/*"/></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td><p align="center">
          <label>
            <input type="radio" name="rad_gender" value="Male" id="rad_gender" required="required"/>
            Male</label>
            <label>
            <input type="radio" name="rad_gender" value="Female" id="rad_gender" />
            Female</label>
            <input type="radio" name="rad_gender" value="Others" id="rad_gender" />
            Others</label>
        </td>
      </tr>
      <tr>
        <td>DOB</td>
         <td><label for="dob_date"></label>
        <input type="date" name="dob_date"  id="dob_date" max="<?php echo date('Y-m-d')?>" required="required"/></td>
        
      </tr>
      <tr>
        <td>State</td>
        <td><label for="sel_state"></label>
          <div align="center">
            <select name="sel_state" id="sel_state" onChange="getDistrict(this.value)" required="required">
              <option value="">-select state-</option>
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
            <select name="sel_district" id="sel_district" onchange = "getPlace(this.value)" required="required">
              <option value="">-select district-</option>
            </select>
        </div></td>
      </tr>
      <tr>
        <td>Place</td>
        <td><label for="sel_place"></label>
          <div align="center">
            <select name="sel_place" id="sel_place" required="required">
              <option value="">-select place-</option>
            </select>
        </div></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><label for="txt_place"></label>
        <input type="password" name="txt_place" id="txt_place" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required"/></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
        </div></td>
      </tr>
    </table>
  </div>
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