<?php
// Joue une musique conneu par son Id
// Inclusion du modèle
require_once('model/music.class.php');
require_once('model/dao.class.php');

$page = $_GET['page'] ?? '';
$pageSize = $_GET['pageSize'] ?? '';
$id = $_GET['id'] ?? '';
$dao = new dao();
$music = $dao->get($id);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="design/style.css">
    <title>playId</title>
  </head>
  <body>
    <header>
      <h1>Playing : Community Centre from Passenger</h1>
    </header>
    <nav>
      <a href="<?="jukebox.php?page=".$page."&pageSize=".$pageSize?>">
        back
      </a>
    </nav>
    <section>
      <figure> 
        <img src="<?=$music->getCover()?>">
        <audio src="<?=$music->getMp3()?>" controls autoplay ></audio>
      </figure>
    </section>

    <br/>
  </body>
</html>
