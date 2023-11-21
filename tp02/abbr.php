<?php
$tab = array('HTML' => 'HyperText Markeup Language', 'XML' => 'eXtended Markeup Language', 'PHP' => 'Hypertext PreProcessor', 'CSS' => 'Cascading Style Sheets');

function abbr(string $abbr): string{
    
    global $tab;
    return '<abbr title="'.$tab[$abbr].'">'.$abbr.'</abbr>';
}

function abbrAll(){

    global $tab;
    $res ='';
    foreach($tab as $key => $value){
        $res .='<tr><th>'.$key.'</th><td>'.$value.'</td></tr>';
    }

    return '<table>'.$res.'</table>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abbr</title>
    <style>
        abbr,
        th
        {
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Exemple d'utilisation des abréviations en HTML</h1>

    <p>Le langage <?= abbr('PHP')?> produit généralement du <?= abbr('HTML')?>  mais peu produire aussi du <?= abbr('XML')?> ou même du <?= abbr('CSS')?>.</p>

    <p>Voici toutes les abbréviations connues :</p>
    <?= abbrall()?>
</body>
</html>
