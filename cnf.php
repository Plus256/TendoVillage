<?php
ob_start();
session_start();
$power="Plus256 Network, Ltd";
$short_name="TendoVillage";
$short_descr="Church News, Events, Entertainment";
//$long_descr="TendoVillage is a Christian blog aiming to unify the church(body of Christ)/edifying the body(church)/ through safe information sharing.";
//$long_descr="TendoVillage is a Christian blog aiming at edifying the Church through sharing actionable information.";
$long_descr="TendoVillage is a community of happy people.";//this community is ideal - always working towards it.
$tagline="Happy People";//Finance, Entertainment, Lifestyle, Gospel, Events.//Have channels from other bloggers.
$logo="gra/logo.png";
$menu_icon="gra/menu_icon.png";
$cover="img/cover.jpg";
//Dynamically Setting Facebook Open Graph Properties
if(isset($_GET['id'])){
	$shule_id=$_GET['id'];
	$q=mysqli_query($conn, "select *, s.id as sid from shule as s join pic as p join user as u on s.author=u.id and s.cover=p.id where s.id=$shule_id");
	$r=mysqli_fetch_assoc($q);
	$og_title=$r['title']; $og_cover="http://www.tendovillage.com/img/".$r['src']; $og_descr=strip_tags($r['body']);
}
else{
	$og_title="TendoVillage";
	$og_descr=$tagline;
	$og_cover="http://www.tendovillage.com/gra/logo.png";
}
?>
