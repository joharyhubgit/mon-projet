<?php
require_once 'functions.php';
$index = $_GET["index"];
if ($index == 1) {
    $nomdepartement = $_POST["search"];
    $departements = rechercheDepartement($nomdepartement);
} else if ($index == 2) {
    $name = $_POST["Name"];
    $age_min = $_POST["age_min"];
    $age_max = $_POST["age_max"];
    $employes = searchEmployeByNameAndAge($name, $age_min, $age_max);
}
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
    <?php if ($index == 1) { ?>
        <h1>Résultats de la recherche (<?= $nomdepartement ?>)</h1>
        <p>Départements trouvés :</p>
        <ul>
            <?php foreach ($departements as $departement): ?>
                <li><?= htmlspecialchars($departement['dept_name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>
    <?php if ($index == 2) { ?>
        <h1>Résultats de la recherche (<?= $name ?>) </h1>
        <?php if ($age_min != null && $age_max != null) { ?>
            <h1>entre <?= $age_min ?> et <?= $age_max ?></h1>
        <?php } ?>
        <p>Personne trouvé :</p>
        <table class="table table-hover">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
            <?php foreach ($employes as $key): ?>
                <tr>
                    <td><?= htmlspecialchars($key['first_name']) ?></td>
                    <td><?= htmlspecialchars($key['last_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php } ?>
</body>

</html>