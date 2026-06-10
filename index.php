<?php 
require_once 'functions.php';
$departements = getDepartmentswithcoll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des departements</h1>
    <ul>
        <table border="1">
            <tr>
                <th>Department Name</th>
                <th>Manager Name</th>
                <th>From Date</th>
                <th>To Date</th>
            </tr>
            <?php foreach ($departements as $departement) : ?>
                <tr>
                    <td> <a href="traitement.php?dept_num=<?= $departement['dept_no'] ?>"><?= $departement['dept_name']; ?></a></td>
                    <td><?= $departement['first_name'] . ' ' . $departement['last_name']; ?></td>
                    <td><?= $departement['from_date']; ?></td>
                    <td><?= $departement['to_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </ul>    
</body>
</html>