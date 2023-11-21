<?php

$music = $_GET['music'];
$source = $_GET['source'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>musique</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <h1><?= $music ?></h1>
        <nav><a href="<?=$source?>">⬅ Retour</a></nav>  
    </header>
    <main>
        <section>
            <figure>
                <img src= "<?="data/".$music.".jpeg"?>" />
                <figcaption>
                    <audio src="<?="data/".$music.".mp3"?>" controls="" autoplay></audio>
                </figcaption>
            </figure>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>
