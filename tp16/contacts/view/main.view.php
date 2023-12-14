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
      <form>
        <input type="text" placeholder="Rechercher">
        <button type="submit" disabled style="display: none" aria-hidden="true"></button>
      </form>
    </h1>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>Prenom</th>
          <th>Nom</th>
          <th>Mobile</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </main>
  <script src="../js/model/dao.js"></script>
  <script src="../js/model/contact.js"></script>
  <script src="../js/view.js"></script>
  <script src="../js/controler.js"></script>
</body>

</html>