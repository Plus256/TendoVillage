<?php
$user_id=$_SESSION['adm_logged'];
$q=mysqli_query($conn, "select * from user as u join dp as d on u.dp=d.id where u.id=$user_id");
$r=mysqli_fetch_assoc($q);
$user_name=$r['uname'];
if(isset($_GET['succ'])){
	$succ=$_GET['succ'];
	switch($succ){
		case 1:
		$succ_msg="Account Setup Successful";
		break;
	}
	?>
	<div class="succ">
		<div class="wrapper">
			<div><?php echo $succ_msg; ?></div>
			<div class="spacer"></div>
		</div>
	</div>
	<?php
}
require_once("adm_ban.php");
if(isset($_GET['option'])){
	require_once("adm_opt_ctrl.php");
}
else{
	require_once("adm_dsh.php");
}
?>
