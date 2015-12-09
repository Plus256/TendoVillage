<?php
require_once("db.php");
require_once("mail.php");
if(isset($_GET['fetch_shule'])){
	$data=array();
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.status=1 order by s.id desc limit 1,6");
	$qt=mysqli_query($conn, "select id from shule");
	$tot_r=mysqli_num_rows($qt);
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat'];
		$published=elapsedTime($published);
		$intro=trunc($intro,25, $id);
		$rec=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category, "tot_r"=>$tot_r);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

if(isset($_GET['top_shule'])){
	$data=array();
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.status=1 order by s.id desc limit 1");
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat'];
		$published=elapsedTime($published);
		$intro=trunc($intro,25, $id);
		$rec=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

if(isset($_GET['shule_cat'])){
	$shule_cat=$_GET['cat_id'];
	switch($shule_cat){
		case "Lifestyle": $shule_cat=1; break;
		case "Gospel": $shule_cat=2; break;
		case "Finance": $shule_cat=3; break;
		case "Entertainment": $shule_cat=4; break;
		case "Events": $shule_cat=5; break;
	}
	$data=array();
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.category=$shule_cat and s.status=1 order by s.id desc limit 6");
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat'];
		$published=elapsedTime($published);
		$intro=trunc($intro,25, $id);
		$rec=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

if(isset($_GET['more_shule'])){
	$shule_id=$_GET['shule_id'];
	$q_v=mysqli_query($conn, "update shule set views=views+1 where id=$shule_id");
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.id=$shule_id");
	$r=mysqli_fetch_assoc($q);
	$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat']; $views=$r['views'];
	$published=elapsedTime($published);
	$data=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category, "views"=>$views);
	echo json_encode($data);
}

if(isset($_GET['fill_right'])){
	$shule_id=$_GET['shule_id'];
	$data=array();
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.id!=$shule_id and s.status=1 order by s.id desc limit 6");
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat'];
		$published=elapsedTime($published);
		$intro=trunc($intro,25, $id);
		$rec=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

function trunc($phrase, $max_words, $this_shule){
	$phrase_array=explode(" ", $phrase);
	if(count($phrase_array)>$max_words && $max_words>0){
		$phrase=implode(" ", array_slice($phrase_array, 0, $max_words))."... "."<a class='read_more' href='shule.php?id=".$this_shule."'>More</a>";
	}
	return $phrase;
}

if(isset($_GET['load_more'])){
    $l_id=$_GET['l_id'];
	$data=array();
	$q=mysqli_query($conn, "select *, s.id as sid, u.uname, c.name as cat from shule as s join pic as p join user as u join cat as c on s.author=u.id and s.cover=p.id and s.category=c.id where s.id<$l_id and s.status=1 order by s.id desc limit 6");
	$qt=mysqli_query($conn, "select id from shule");
	$tot_r=mysqli_num_rows($qt);
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['sid']; $title=$r['title']; $cover=$r['src']; $intro=$r['body']; $published=$r['created']; $author=$r['uname']; $category=$r['cat'];
		$published=elapsedTime($published);
		$intro=trunc($intro,25, $id);
		$rec=array("id"=>$id, "title"=>$title, "cover"=>$cover, "intro"=>$intro, "published"=>$published, "author"=>$author, "category"=>$category, "tot_r"=>$tot_r);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

if(isset($_GET['fetch_ad'])){
	$data=array();
	$q=mysqli_query($conn, "select *, a.id as aid from ad as a join pic as p on a.pic=p.id where a.status=1 order by a.id desc limit 5");
	while($r=mysqli_fetch_assoc($q)){
		$id=$r['aid']; $title=$r['title']; $pic=$r['src']; $descr=$r['descr']; $exl=$r['exl']; $type=$r['type'];
		$rec=array("id"=>$id, "title"=>$title, "pic"=>$pic, "descr"=>$descr, "exl"=>$exl, "type"=>$type);
		array_push($data, $rec);
	}
	echo json_encode($data);
}

if(isset($_GET['send_msg'])){
    if(!empty($_POST['frm'])){
		$mail_check=spamCheck($_POST['frm']);
		if($mail_check==false){
			echo '{"ret":"0"}';
		}
		else{
			if(!empty($_POST['msg']) && $_POST['msg']!="Write Message Here..." && preg_match("/^[0-9a-zA-Z]+/", $_POST['msg'])){
				$to="happy@tendovillage.com";
				$frm=cleanInput($_POST['frm']);
				$sbj=cleanInput($_POST['sbj']);
				$msg=cleanInput($_POST['msg']);

				$q=mysqli_query($conn, "select id, email from news_l where email='$frm'");
			    if(mysqli_num_rows($q)>0){
			    	//email exists in our news_l subscriptions
			    	sendMsg($to, $frm, $sbj, $msg);
			    }
			    else{//new email
			    	$q=mysqli_query($conn, "insert into news_l (email) values ('$frm')");
			    	if($q){
			    		sendMsg($to, $frm, $sbj, $msg);
			    	}
			    }
			}
			else{
				echo '{"ret":"1"}';
			}
		}
	}
	else{
		echo '{"ret":"0"}';
	}
}

function spamCheck($field){
	//sanitize email
	$field=filter_var($field, FILTER_SANITIZE_EMAIL);
	//validate email
	if(filter_var($field, FILTER_VALIDATE_EMAIL)){
		return true;
	}
	else{
		return false;
	}
}

function cleanInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data, "<br>");
	return $data;
}

function elapsedTime($t_stamp){
	$occurred=strtotime($t_stamp)+(7*60*60);//add 7 hours to cater for Ugandan Time Zone
	$diff=time()-$occurred;
	if($diff<60){
		$elapsed=$diff;
		if($elapsed==1){
			$elapsed=$elapsed." Second";
		}
		else{
			$elapsed=$elapsed." Seconds";
		}
	}
	elseif($diff>=60 && $diff<(60*60)){
		$elapsed=floor($diff/(60));
		if($elapsed==1){
			$elapsed=$elapsed." Minute";
		}
		else{
			$elapsed=$elapsed." Minutes";
		}
	}
	elseif($diff>=(60*60) && $diff<(60*60*24)){
		$elapsed=floor($diff/(60*60));
		if($elapsed==1){
			$elapsed=$elapsed." Hour";
		}
		else{
			$elapsed=$elapsed." Hours";
		}
	}
	elseif($diff>=(60*60*24) && $diff<(60*60*24*7)){
		$elapsed=floor($diff/(60*60*24));
		if($elapsed==1){
			$elapsed=$elapsed." Day";
		}
		else{
			$elapsed=$elapsed." Days";
		}
	}
	else{
		$elapsed=date("M jS, Y", $occurred);
	}
	return $elapsed;
}
?>
