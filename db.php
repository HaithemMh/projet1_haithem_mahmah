<?php  
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_TABLE", 'e-commerce-store');

$conn = mysqli_connect(DB_HOST , DB_USER , DB_PASS , DB_TABLE);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
 // mysqli_close($conn);

}

?>