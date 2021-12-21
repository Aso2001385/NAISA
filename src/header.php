<?php 
require_once './Logic/Authent_Logic.php';
$li_output = Authent_Logic::header_set();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/common.css">
  <?php echo "<link rel='stylesheet' href='css/{$page_css}.css'>" ?>
  <title></title>
</head>
<body>
<header>
  <a href="index.php"><div class="header-logo">NAISA!</div></a>
  <form class="search_form" action="index.php" method="post">
    <img class="search-icon" src="img/search.png">
    <input type="text" name='keyword' class="search-box">
    <button class='search_btn'>検索</button>
  </form>
  <ul>
    <?php echo $li_output; ?>  
  </ul>
</header>
<div class="main">