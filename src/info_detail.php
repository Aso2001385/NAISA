<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Info_Logic.php';

if(!isset($_SESSION['user']) || !isset($_GET['id'])) header('Location.index.php');

$act = Info_Logic::get_single($_GET['id']);
$info = $act['data'];

if($act['check'] && !is_bool($info)) header('Location.index.php');
if($info['user_id'] != $_SESSION['user']['id'])  header('Location.index.php');
$info['contents'] = nl2br(Info_Logic::link_converter($info['links'],$info['contents']));
$page_css = 'info_detail';
require_once 'header.php';
?>

<div class="contents">
    <div class="info_frame">
        <div class="info_subject"><?php echo $info['subject']?></div>
        <div class="info_contents"><?php echo $info['contents']?></div>
    </div>
</div>

<?php

require_once 'footer.php';

?>