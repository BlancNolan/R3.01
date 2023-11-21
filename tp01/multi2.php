<?php

    print("Donner la table : ");
    fscanf(STDIN, "%d\n", $number);
    if($number == false | $number == NULL){
        exit("erreur de saisie !!\n");
    }

    printf("Table du %d\n", $number);

    for($i=1; $i<=10; $i++){

        printf("%d * %d = %d\n", $number, $i, $i*$number);
    }

?>