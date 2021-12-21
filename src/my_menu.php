<?php
session_start();
require_once 'Logic/Purchase_Logic.php';
require_once 'Logic/Exhibit_Logic.php';



$page_css = 'my_menu';

require_once 'header.php';

?>

<div class="contents">

    <a href="exhibition_list.php"><div class="subject">・マイリスト・</div></a>

    <a href="item_register.php"><div class="subject">・出品する・</div></a>

    <a href="user_edit.php"><div class="subject">・アカウント情報確認・</div></a>

</div>

<?php

require_once 'footer.php';

?>