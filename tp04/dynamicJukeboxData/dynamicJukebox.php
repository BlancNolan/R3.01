<?php
include('readDelimitedData.php');
// Lecture de toutes les musiques
$tab = readDelimitedData("test.txt");
$self=$_SERVER['PHP_SELF'];

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox static</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <main>
    <section>
      <?php
        foreach($tab as $musics): echo
        <<<MUSICS
          <figure>
            <a href="playPath.php?music=$musics[0]/$musics[1]&source=$self">
              <img src="data/$musics[0]/$musics[1].jpeg">
            </a>
            <figcaption>
              <music-song>$musics[1]</music-song>
              <music-group>$musics[0]</music-group>
            </figcaption>
          </figure>
        MUSICS;
        endforeach;
      ?>
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
