<?php //this is taken from connectinDatabase.php and included with. select.php 
$conn_error = 'Could not connect.'; 
$mysql_host = 'localhost'; 
$mysql_user = 'root'; 
$mysql_pass = ''; 

$conn = mysqli_connect($mysql_host,$mysql_user, $mysql_pass);
$db = mysqli_select_db($conn ,'test');
if(!@$conn || !@db)
{   die("eror"); } 
?>