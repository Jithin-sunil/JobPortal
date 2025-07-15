<?php
 $result=NULL;
 

 if(isset($_POST['btn_add']))
 {
	 $num1=$_POST['txt_number1'];
	 $num2=$_POST['txt_number2'];
	 $result=$num1+$num2;
 }
 
  if(isset($_POST['btn_sub']))
 {
	 $num1=$_POST['txt_number1'];
	 $num2=$_POST['txt_number2'];
	 $result=$num1-$num2;
 }
 
  if(isset($_POST['btn_multi']))
 {
	 $num1=$_POST['txt_number1'];
	 $num2=$_POST['txt_number2'];
	 $result=$num1*$num2;
 }
 
  if(isset($_POST['btn_div']))
 {
	 $num1=$_POST['txt_number1'];
	 $num2=$_POST['txt_number2'];
	 $result=$num1/$num2;
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
<table width="253" border="1">
  <tr>
    <td width="73"><p>Number1</p></td>
    <td width="168">
      <label for="txt_number1"></label>
      <input type="text" name="txt_number1" id="txt_number1">
    </td>
  </tr>
  
  <tr>
    <td>Number2</td>
    <td>
      <label for="txt_number2"></label>
      <input type="text" name="txt_number2" id="txt_number2">
  </td>
  </tr>
  
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="btn_add" id="btn_add" value="+">
      <input type="submit" name="btn_sub" id="btn_sub" value="-">
      <input type="submit" name="btn_multi" id="btn_multi" value="*">
      <input type="submit" name="btn_div" id="btn_div" value="/">
    </td>
  </tr>
  <tr>
    <td>Result</td>
    <td><?php echo $result; ?>
    </td>
  </tr>
</table>
</form>

</body>
</html>
