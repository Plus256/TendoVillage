<?php
$q=mysqli_query($conn, "select * from cat order by id asc");
?>
<div id="menu">
    <div><?php echo file_get_contents("gra/ic_menu.svg"); ?></div>
    <div id="menu_container">
      <div id="menu_drawer_cancel"><?php echo file_get_contents("gra/ic_cancel.svg"); ?></div>
        <ul>
        <?php
        if($q){
            while($r=mysqli_fetch_assoc($q)){
                echo "<li><a href='./?cat=".$r['name']."'>".$r['name']."</a></li>";
            }
        }
        ?>
        </ul>
        <div class="spacer"></div>
    </div>
    <div class="spacer"></div>
</div>
<?php
?>
