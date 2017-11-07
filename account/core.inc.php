<?php
 ob_start();
 session_start();
 $current_file = $_SERVER['SCRIPT_NAME'];
 $http_referer = @$_SERVER['HTTP_REFERER'];
 
 function loggedin() {
  if (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
   return true;
   } else {
   return false;
  }
 }
 
 //= '' after $field to work correctly
 function getuserfield($field = '') { 
  // some global variables were needed for code to work properly
  global $conn;
  global $username;
  global $password_hash;
  //took me literaly 2 days to find my way around this code
  $x = $_SESSION['user_id']; 
  $id = $x['id']; 
  //echo $id; //used in testing if it gives correct id
  //".$_SESSION['user_id']." does not work for me, so I found my way around
  $query = "SELECT `$field` FROM `test` WHERE `id` = '$id'";
  $query_run = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($query_run)) {
   foreach ($row as $key => $val) {
    return $val;
   }
  }
 }
?>
