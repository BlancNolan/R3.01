<!-- Partie d'une vue : le menu -->
<nav>
  <form action="menu.ctrl.php" method="get">
    <ul>
      <li>
        Acces
        <ul>
          <li>
            <button type="submit" name="access" value="login">Login</button>
          </li>
          <li>
            <button type="submit" name="access" value="logout">Logout</button>
          </li>
        </ul>
      </li>
      <li>
        Les Articles
          <ul>
            <li>
              <button type="submit" name="article" value="create">Ajouter</button>
            </li>
            <li>
              <button type="submit" name="article" value="read">Acceder</button>
            </li>
            <li>
              <button type="submit" name="article" value="update">Modifier</button>
            </li>
            <li>
              <button type="submit" name="article" value="delete">Supprimer</button>
            </li>
          </ul>
          <input type="hidden" name="ref" value="<?=$ref?>">
        </form>

      </li>
    </ul>
</nav>
