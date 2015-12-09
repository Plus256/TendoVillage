<?php
$conn=mysqli_connect("127.0.0.1", "root", "root");
if (!$conn) {
	die('Connect Error (' . mysqli_error());
}
$db_selected = mysqli_select_db($conn, 'tendovillage');
if (!$db_selected) {
	die ('Can\'t use db : ' . mysqli_error());
}
?>
