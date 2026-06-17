<?php
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$emp_no = intval($_POST['emp_no']);
$dept_no = isset($_POST['dept_no']) ? mysqli_real_escape_string(dbconnect(), $_POST['dept_no']) : '';
$dateDebut = isset($_POST['dateDebut']) ? mysqli_real_escape_string(dbconnect(), $_POST['dateDebut']) : '';
$manager_from_date = isset($_POST['manager_from_date']) ? $_POST['manager_from_date'] : '';

$erreurs = [];

if (empty($dateDebut)) {
    $erreurs[] = "La date de début est obligatoire.";
}

if (!empty($dept_no) && isDejaManager($emp_no, $dept_no)) {
    $erreurs[] = "Cet employé est déjà manager de ce département.";
}

if ($manager_from_date && !empty($dateDebut) && strtotime($dateDebut) <= strtotime($manager_from_date)) {
    $erreurs[] = "La date de début ($dateDebut) doit être postérieure à la date du manager actuel ($manager_from_date).";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Changement Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h2>Nomination au poste de Manager</h2>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-danger">
            <strong> Erreur :</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($erreurs as $e): ?>
                    <li><?= $e ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="javascript:history.back()" class="btn btn-secondary">← Retour</a>

    <?php else: ?>
        <?php $succes = insertNouveauManager($emp_no, $dept_no, $dateDebut); ?>

        <?php if ($succes): ?>
            <div class="alert alert-success">
                L'employé <strong>#<?= $emp_no ?></strong> est maintenant manager
                du département <strong><?= $dept_no ?></strong>
                depuis le <strong><?= $dateDebut ?></strong>.
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Erreur lors de la nomination en base de données.
            </div>
        <?php endif; ?>

        <a href="fiche.php?num_e=<?= $emp_no ?>" class="btn btn-primary">← Retour à la fiche</a>

    <?php endif; ?>

</body>

</html>