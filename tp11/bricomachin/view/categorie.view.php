<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
  <title>Selection des categorie</title>
</head>
<body>
  <h1>Choisir une catégorie</h1>
  <h2><?=$categoriePere->getNom()?></h2>
  <a href="afficherArticles.ctrl.php"><img src="../view/design/home.png"/></a>
  <form class="categorie" action="choisirCategorie.ctrl.php" method="get">
    <?php foreach ($categories as $categorie): 
            if(empty($categorie->readSubCategorie())):
      ?>
      <button type="submit" formaction="afficherArticles.ctrl.php" name="idCategorie" value="<?= $categorie->getId()?>">
        <?= $categorie->getNom()?>
      </button>
      <?php else: ?>
      <button type="submit" name="idCategorie" value="<?= $categorie->getId()?>">
        <?= $categorie->getNom()?>
      </button>

    <?php endif;
  endforeach; ?>
  </form>
  
</body>
</html>
