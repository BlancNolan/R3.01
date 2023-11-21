<?php
// Inclusion du modèle
require_once('model/music.class.php');
require_once('model/dao.class.php');

$dao = new dao();

$page = $_GET['page'] ?? 1;
$pageSize = $_GET['pageSize'] ?? 8;

$maxPage = ceil(($dao->maxId())/$pageSize);
if( $page > $maxPage) $page = $maxPage;

$id = $dao->minId() + ($page-1)*$pageSize;


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox avec BD</title>
  <link rel="stylesheet" type="text/css" href="design/style.css">
  <title></title>
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <!-- Navigation -->
  <nav>
    <p>
      <a href="<?="jukebox.php?page=".(($page <= 8)? 1:$page-8)."&pageSize=".$pageSize?>">
        <span class="arrow left"></span><span class="arrow left"></span>
      </a>
      <a href="<?="jukebox.php?page=".(($page == 1)? 1: $page-1)."&pageSize=".$pageSize?>">
        <span class="arrow left"></span>
      </a>

      <?php 
        $index = ($page < ($maxPage-7)) ? $page : $maxPage-7;
        $maxIndex = ($page < ($maxPage-7)) ? $page+7 : $maxPage;

       for($index; $index <= $maxIndex; $index++):
          if($index == $page) :
      ?>
          <a class="selected" href="<?="jukebox.php?page=".$index."&pageSize=".$pageSize?>"><?= $index?></a>
      <?php else:?>
          <a href="<?="jukebox.php?page=".$index."&pageSize=".$pageSize?>"><?= $index?></a>
      <?php 
        endif;
       endfor;
      ?>

      <a href="<?="jukebox.php?page=".(($page == $maxPage)? $maxPage : $page+1)."&pageSize=".$pageSize?>">
        <span class="arrow right"></span>
      </a>
      <a href="<?="jukebox.php?page=".(($page > ($maxPage-8))? $maxPage : $page+8)."&pageSize=".$pageSize?>">
        <span class="arrow right"></span><span class="arrow right"></span>
      </a>
    </p>
    <form action="jukebox.php" method="get">
      <p>Musiques/page</p>
      <input type="hidden" name="page" value="<?= $page?>">
      <input type="text" name="pageSize" value="<?= $pageSize?>" maxlength="4" size="2">
      <input type="submit" style="display: none;">
    </form>
  </nav>

  <!-- Contenu principal -->
  <main>
    <section>

    <?php for($id; $id <= ($pageSize*$page) && $id <= $dao->maxId(); $id++):
          $music = $dao->get($id);
    ?>
        <figure>
          <a href="<?="playId.php?id=".$id."&page=".$page."&pageSize=".$pageSize?>">
            <img src="<?= $music->getCover()?>"/>
          </a>
          <figcaption>
            <music-song><?= $music->getTitle()?></music-song>
            <music-group><?= $music->getAuthor()?></music-group>
            <music-category><?= $music->getCategory()?></music-category>
          </figcaption>
        </figure>

    <?php endfor;?>

      
    </section>
  </main>
  <footer>
    Jukebox IUT
  </footer>
</body>
</html>
