<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("classes/wartung.class.php");
    ?>
    <a href="index.php">Hauptmenü</a>

    <br>

    <h1>Wartung</h1>

    <form action="" method="post">
        <input type="text" name="suchbegriff"> 
        <input type="submit" value="Suchen">
    </form>


    <p>
        <a href="wartung_edit.php">Neu...</a>
    </p>
    <table border=1>
        <?php

            $wartungClass = new wartung();
            //$objekt = $wartungClass->bekomObjekt();
            //$objekt = $wartung->bekomObjekt();
            $wartungen = wartung::ladeAlle($_POST['suchbegriff']??"");

            foreach($wartungen as $wartung) 
            {
                $objekt = $wartungClass->bekomObjekt($wartung->id);
                echo '
                <tr>
                    <td>'.$wartung->datum_wartung.'</td>
                    <td>'.$wartung->mitName_wartung.'</td>
                    <td>'.$wartung->notiz_wartung.'</td>
                    <td>'.$objekt.'</td>
                    <td>
                    <a href="wartung_loeschen.php?id_wartung='.$wartung->id.'">Löschen</a>
                    <a href="wartung_edit.php?id_wartung='.$wartung->id.'">Editieren</a>
                    </td>
                </tr>';

            }
        ?>
    </table>
</body>
</html>