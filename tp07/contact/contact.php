<?php
// récupère les informations de la query string
$city = $_GET['city'] ?? 'Dallas';

$dataSourceName = 'sqlite:'.__DIR__.'/data/contact.db';
$db = new PDO($dataSourceName);
$pdoSth = $db->query("SELECT * FROM contact where city='$city'");
$data = $pdoSth->fetchall();


 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="design/style.css">
    <title>My contacts</title>
  </head>
  <body>
    <h1>My contacts from <?= $city ?></h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Phone</th>
      </tr>

      <?php foreach ($data as $contact): ?>
        <tr>
          <td>
            <?= $contact['name'] ?>
          </td>
          <td>
            <?= $contact['phone'] ?>
          </td>
        </tr>
      <?php endforeach; ?>
        
    </table>
  </body>
</html>
