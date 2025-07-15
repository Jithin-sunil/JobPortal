<?php
   $num1=NULL;
   $num2=NULL;


  if(isset($_POST['btn_check']))
  {
	  $num1=$_POST['txt_number1'];
	  $num2=$_POST['txt_number2'];
	  
 }


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post">
<table width="200" border="1">
  <tr>
    <td>Number 1</td>
    <td>
      <label for="txt_number1"></label>
      <input type="text" name="txt_number1" id="txt_number1" />
   </td>
  </tr>
  <tr>
    <td>Number 2</td>
    <td>
      <label for="txt_number2"></label>
      
      <input type="text" name="txt_number2" id="txt_number2" />
      </td>
  </tr>
  <tr>
    <td colspan="2">
      <div align="center">
        <input type="submit" name="btn_check" id="btn_check" value="Check" />
      </div>
    </td>
  </tr>
  <tr>
    <td>Largest</td>
    <td>
	<?php  
	 if($num1>$num2)
	 {
		 echo $num1;
	 }
	 else
	 {
		 echo $num2; 
	 }
	 
	?> 
	</td>
  </tr>
  <tr>
    <td>Smallest</td>
    <td> 
   	<?php  
	 if($num1>$num2)
	 {
		 echo $num2;
	 }
	 else
	 {
		 echo $num1; 
	 }
	 
	?> 
	</td>
  </tr>
</table>
</form>

</body>
</html>