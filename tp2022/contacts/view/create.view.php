<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Contacts</title>
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>

<body>
  <header>
    <h1><img src="../view/design/img/contacts_60.png" alt="Icon contact"> Contacts
      <data value="<?= $pattern ?>">
        <?= $pattern ?>
      </data>
    </h1>
  </header>
  <aside>
    <!-- Boutons se référent au formulaire dans main  -->
    <!-- Chaque bouton est associé à son contrôleur -->
    <button form="form" formaction="search.ctrl.php">Annuler</button>
    <button form="form" formaction="create.ctrl.php">Ajouter</button>
  </aside>
  <main>
  <form id="form">
      <table>
        <tbody>
          <tr>
            <th>Nom</th>
            <td>
              <input type="text" name="nom" placeholder="indiquer le nom">
            </td>
          </tr>
          <tr>
            <th>Prénom</th>
            <td>
              <input type="text" name="prenom" placeholder="indiquer le prénom">
            </td>
          </tr>
          <tr>
            <th>Mobile</th>
            <td>
              <input type="text" name="mobile" placeholder="indiquer le No de téléphone mobile">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </main>
</body>

</html>