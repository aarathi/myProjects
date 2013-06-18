<?php 
//Database connection
$con=mysqli_connect("localhost","root","root") or die ("Error: Could not connect to mysql");
 mysqli_select_db("qb_blog",$con) or die ("Database does not exist");
?>

