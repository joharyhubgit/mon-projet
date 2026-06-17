<?php
include("functions.php");
session_start();
$departements = getAllDepartements();
// echo $departements["dept_name"];
$num_e = $_SESSION["num_e"];
$dept_num = $_SESSION["dept_num"];
$dept_nom_act = getNamedept($dept_num);
$dept_nom = getNamedept($dept_num);
// echo $dept_nom;
// echo $dept_num;
// echo $num_e;
$info = getactualdept($dept_num,$num_e);
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        
        <form action="traitement_change.php" method="post">
            <h4>departement actuelle <?= $dept_nom_act ?></h4>
            <h4>Date de debut</h4>
            <?php foreach ($info as $key) {
                echo $key["from_date"];
            } ?>
            <br>
            <br>
            <label>choix departement</label>
        <select name="departement" id="">
            <?php foreach ($departements as $key) { ?>
                <option value="<?= $key["dept_name"] ?>"><?= $key["dept_name"] ?></option>
            <?php } ?>
        </select>
        <br><label for="date">date de debut</label>
        <input type="date" name="Datedebut"><br>
        <input type="submit" value="changer de departement">
    </form>
</body>

</html>