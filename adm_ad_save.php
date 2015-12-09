<?php
$shule_title=mysqli_real_escape_string($conn, $_POST['shule_title']);
$shule_cover=$_FILES['shule_cover']['name'];
$shule_cat=mysqli_real_escape_string($conn, $_POST['shule_cat']);
$shule_ctype=mysqli_real_escape_string($conn, $_POST['shule_ctype']);
$shule_status=mysqli_real_escape_string($conn, $_POST['shule_status']);
$shule_body=mysqli_real_escape_string($conn, $_POST['shule_body']);
$shule_author=$_SESSION['adm_logged'];
$upload=move_uploaded_file($_FILES['shule_cover']['tmp_name'], "./img/".$_FILES['shule_cover']['name']);
if($upload){
	$q=mysqli_query($conn, "insert into pic (src) values ('$shule_cover')");
	if($q){
		mysqli_query($conn, "select last_insert_id() into @shule_cover");
		$q=mysqli_query($conn, "insert into shule (title, cover, body, author, status, category, ctype) values ('$shule_title', @shule_cover, '$shule_body', $shule_author, $shule_status, $shule_cat, $shule_ctype)");
		if($q){
			header('Location:'.$_SERVER['PHP_SELF'].'?option=Shules');
		}
		else{echo mysqli_error();}
	}
}
else{
	print_r($_FILES);
}
?>
