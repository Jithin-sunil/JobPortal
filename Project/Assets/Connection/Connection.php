<?php
$Server="localhost";
$User="root";
$Password="";
$Db="db_jobportal";
$Con=mysqli_connect($Server,$User,$Password,$Db);
if(!$Con)
{
	echo "Connection Error";
}
?>