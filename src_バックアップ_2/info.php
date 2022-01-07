<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Info_Logic.php';
if(!isset($_SESSION['user'])){
    header('Location:login.php');
    exit();
}

$act = Info_Logic::get_multi($_SESSION['user']['id']);

if($act['check'] && !is_bool($act['data'])){

    $output = '';

    foreach($act['data'] as $info){
        
        $info_box  = "<a href='info_detail.php?id={$info['id']}'><div class='info_box'>";
        $info_box .= "<div class='info_subject'>{$info['subject']}</div></div></a>";

        $output .= $info_box;

    }

}else{

    $output = "<div class='info_box'><div class='info_subject'>お知らせはありません</div></div>";

}


$page_css = 'info';
require_once 'header.php';
?>

<div class="contents">
    <div class="info_frame">
        <?php echo $output?>
    </div>
</div>

<?php

require_once 'footer.php';

?>