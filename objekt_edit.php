<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objekt</title>
</head>

<body>

    <h1>Objekt anlegen/editieren</h1>

    <p>
        <a href="objekt.php"> &lt; zurück</a>
    </p>
    <?php
    
        require_once('classes/objekt.class.php');
        
        if(!empty($_REQUEST['id_objekt'])) {
            $o = objekt::laden($_REQUEST['id_objekt']);
        } else {
            $o = new objekt();
        }

        if(isset($_POST['abgeschickt'])) {
            $o->name_objekt = $_POST['name'];
            $o->kategorie_objekt = $_POST['kategorie'];
            $o->intervall_objekt = $_POST['intervall'];
            $o->speichern();
            header("location:objekt.php");
        }
    ?>
    <form action="" method="post">
        <input type="text" name="name" value="<?= $o->name_objekt ?>">
        <input type="text" name="kategorie" value="<?= $o->kategorie_objekt ?>">
        <input type="text" name="intervall" value="<?= $o->intervall_objekt ?>">
        <input type="hidden" name="id_objekt" value="<?= $o->id ?>">
        <input type="hidden" name="abgeschickt" value="true">
        <input type="submit" value="OK">
    </form>
</body>

</html>