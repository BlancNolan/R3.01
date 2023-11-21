<?php

$dataSourceName = 'sqlite:'.__DIR__.'/data/contact.db';
$db = new PDO($dataSourceName);
$pdoSth = $db->query("SELECT distinct city FROM contact");
$city = $pdoSth->fetchall();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select city</title>
    <link rel="stylesheet" href="./design/style.css">
</head>
<body>
    <form action="contact.php" methode="GET">
        <h1>My contacts : select a city</h1>
        <table>
            <?php foreach ($city as $values):?>
            <tr>
                <td><label for="<?= $values['city']?>"><?= $values['city']?></label></td>
                <td><input type="radio" name="city" id="<?= $values['city']?>" value="<?= $values['city']?>"/></td>
            
            </tr>
            
        <?php endforeach;?>
            
        <td><button type="submit">Select</button></td>
        
        </table>
       
    </form>
</body>
</html>