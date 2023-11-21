

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>multiplication 3 </title>
    <style>

        *{
            box-sizing: border-box;
        }
        table {
            border-collapse: collapse;
        }
        th,
        td{
          border: 1px solid #333; 
          padding: 2px;  
        }

        td{
            text-align: center;
        }


    </style>
</head>
<body>
    <h1>Table de multiplication</h1>

    <table>
        <tr>
            <th scope="col"></th>
            <th scope="col">1</th>
            <th scope="col">2</th>
            <th scope="col">3</th>
            <th scope="col">4</th>
            <th scope="col">5</th>
            <th scope="col">6</th>
            <th scope="col">7</th>
            <th scope="col">8</th>
            <th scope="col">9</th>
            <th scope="col">10</th>
        </tr>
        <?php for($i = 1; $i<=10; $i++){?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <?php for($j = 1; $j<=10; $j++){?>
                    <td><?= $i*$j ?></th>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</body>
</html>