<?php
$a = isset($_GET['a']) ? $_GET['a'] : 0;
$b = isset($_GET['b']) ? $_GET['b'] : 0;
$op = isset($_GET['op']) ? $_GET['op'] : "operator op missing";
        
switch($op){

    case '+':
        $res = $a + $b;
        break;
    case '-':
        $res = $a - $b;
        break;
    case '*':
        $res = $a * $b;
        break;
    case '/':
        $res = $a / $b;
        break;
    default:
        exit($op);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calcul</title>
</head>
<body>
    

<h1>calcul</h1>
<p>
    <?= $a ?> <?= $op ?> <?= $b ?> = <?= $res?>
</p>

</body>
</html>   
