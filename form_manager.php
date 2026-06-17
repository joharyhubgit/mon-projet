<?php
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$emp_no  = intval($_POST['emp_no']);
$dept_no = isset($_POST['dept_no']) ? mysqli_real_escape_string(dbconnect(), $_POST['dept_no']) : '';
$manager = getManagerActuel($dept_no);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Devenir Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Nomination au poste de Manager</h2>

    <!-- Manager actuel -->
    <?php if ($manager): ?>
        <div class="alert alert-info">
            <strong>Manager actuel :</strong>
            <?= htmlspecialchars($manager['first_name'] . ' ' . $manager['last_name']) ?>
            &nbsp;|&nbsp;
            <strong>En poste depuis :</strong> <?= $manager['from_date'] ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Aucun manager actuellement dans ce département.
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form action="changetomanager.php" method="post">
        <input type="hidden" name="emp_no"            value="<?= $emp_no ?>">
        <input type="hidden" name="dept_no"           value="<?= $dept_no ?>">
        <input type="hidden" name="manager_from_date" value="<?= $manager['from_date'] ?? '' ?>">

        <div class="mb-3">
            <label class="form-label">Date de début :</label>
            <input type="date" name="dateDebut" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmer</button>
        <a href="fiche.php?num_e=<?= $emp_no ?>" class="btn btn-secondary"> Annuler</a>
    </form>

</body>
</html>