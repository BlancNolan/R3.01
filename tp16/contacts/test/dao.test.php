<?php
// Test de la classe DAO
require_once(__DIR__ . '/../model/dao.class.php');
// Fonctions d'aide
require_once(__DIR__ . '/../test/helper.php');

try {
  print("Création d'un objet DAO : ");
  $dao = DAO::get();
  OK();

  print("Test d'une lecture par query : ");
  $query = "SELECT * FROM contact WHERE id=?";
  $id = 1;
  $data = [$id];
  $value = $dao->query($query, $data);
  $expected = array(
    array(
      "id" => 1,
      0 => 1,
      "prenom" => "Karl",
      1 => "Karl",
      "nom" => "Lage",
      2 => "Lage",
      "mobile" => 705770116,
      3 => 705770116
    )
  );
  if ($value != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Contact No $id non trouvé");
  }
  OK();

} catch (Exception $e) {
  printCol("\nErreur sur DAO : " . $e->getMessage() . "\n");
}


?>