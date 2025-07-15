<?php
$name=NULL;
$contact=NULL;
$class=NULL;
$semester=NULL;
$total=NULL;
$perc=NULL;




if(isset($_POST['btn_submit']))
{
   $fname=$_POST['txt_firstn'];
   $lname=$_POST['txt_lastn'];
   $name=$fname. " " .$lname;
}
if(isset($_POST['btn_submit']))
{
   $contact=$_POST['txt_contact'];
}
if(isset($_POST['btn_submit']))
{
   $class=$_POST['opt_class'];
}
if(isset($_POST['btn_submit']))
{
   $semester=$_POST['opt_sem'];
}
if(isset($_POST['btn_submit']))
{
   $fname=$_POST['txt_firstn'];
   $lname=$_POST['txt_lastn'];
   $name=$fname. " " .$lname;
}
if(isset($_POST['btn_submit']))
{
	$mark1=$_POST['txt_mark1'];
	$mark2=$_POST['txt_mark2'];
	$mark3=$_POST['txt_mark3'];

	$total=$mark1+$mark2+$mark3;
}
if(isset($_POST['btn_submit']))
{
	$perc=((($total)/300)*100);
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form id="form1" name="form1" method="post" action="">

<table border="4">
  <tr>
    <td>First Name</td>    
     <td>
      <label for="txt_firstn"></label>
      <div align="center">
        <input type="text" name="txt_firstn" id="txt_firstn" />
      </div>   
     </td>
  </tr>
  
  
  <tr>
    <td>Last Name</td>  
     <td>
      <label for="txt_lastn"></label>
      <div align="center">
       <input type="text" name="txt_lastn" id="txt_lastn" />
      </div>    
     </td>
  </tr>
  
  
  <tr>
    <td>Contact</td>   
     <td>
      <label for="txt_contact"></label>
       <div align="center">
        <input type="text" name="txt_contact" id="txt_contact" />
       </div>      
      </td>
  </tr>
  
  
  <tr>
    <td>Class</td>    
     <td>
      <label for="opt_class"></label>
      <div align="center">
        <select name="opt_class" id="opt_class">
          <option>select</option>
          <option value="A-BATCH">A-BATCH</option>
          <option value = "B-BATCH">B-BATCH</option>
          <option value = "C-BATCH">C-BATCH</option>
        </select>
      </div>    
     </td>
  </tr>
  
  
  <tr>
    <td>Semester</td>    
     <td>
      <label for="opt_sem"></label>
      <div align="center">
        <select name="opt_sem" id="opt_sem">
          <option>semester</option>
          <option value="SEM-1">I</option>
          <option value="SEM-2">II</option>
          <option value="SEM-3">III</option>
          <option value="SEM-4">IV</option>
          <option value="SEM-5">V</option>
          <option value="SEM-6">VI</option>
        </select>
      </div>   
     </td>
  </tr>
  
  
  <tr>
    <td>Mark 1</td>    
     <td>
      <label for="txt_mark1"></label>
      <div align="center">
        <input name="txt_mark1" type="text" id="txt_mark1" placeholder=         "100"/>
      </div> 
     </td>
  </tr>
  
  
  <tr>
    <td><p>Mark 2</p></td>  
     <td>
      <label for="txt_mark2"></label>
      <div align="center">
        <input type="text" name="txt_mark2" id="txt_mark2" placeholder=         "100" />
      </div>   
     </td>
  </tr>
  
  
  <tr>
    <td>Mark 3</td> 
     <td>
      <label for="txt_mark3"></label>
      <div align="center">
        <input type="text" name="txt_mark3" id="txt_mark3" placeholder=         "100"/>
      </div>
     </td>
  </tr>
  
  
  <tr>
    <td colspan="2">
      <div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value=         "Submit" />
        <input type="submit" name="btn_clear" id="btn_clear" value=        "Clear" />
      </div>
     </td>
  </tr>
  
  
  <tr>
    <td>Name</td>   
   <td>
     <?php
       echo $name;
     ?> 
    </td>
  </tr>
  
  
  <tr>
    <td>Contact</td>     
     <td>
       <?php
       echo $contact;
       ?> 
      </td>
    </tr>
    
    
  <tr>
    <td>Class</td>
    <td>
        <?php
        echo $class;
        ?> 
     </td>
  </tr>
  
  
  <tr>
    <td>Semester</td>
    <td>
       <?php
       echo $semester;
      ?> 
    </td>
  </tr>
  
  
  <tr>
    <td>Total Mark</td>
    <td>
        <?php
       echo $total;
     ?> 
    </td>
  </tr>
  
  
  <tr>
    <td>Grade</td>
     <td>
      <?php
     	 if($total>280)
	 {
		 echo "A-Grade";
	      }
	 elseif($total>250)
	 {
         echo "B-Grade";	
		  }
     elseif($total>200)
	 {
         echo "C-Grade";	
		  } 
     elseif($total>150)
	 {
         echo "D-Grade";	
		  }
	 else
	 {
         echo "Failed";	
		  }
	 ?>

    </td>
  </tr>
  
  
  <tr>
    <td>Percentage</td>
    <td>
       <?php
	   
       echo $perc;
     ?>    
    </td>
  </tr>
</table>
</form>
</body>
</html>