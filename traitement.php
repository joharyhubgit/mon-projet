<?php 
session_start();
$index = $_GET["dept_num"];
$_SESSION["dept_num"] = $index;
require_once 'functions.php';
$liste = getAllEMployeesinDept($index);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés — Département <?= htmlspecialchars($index) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Employés
                <span class="dept-badge"><?= htmlspecialchars($index) ?></span>
            </h1>
            <a href="index.php" class="btn-back">&#8592; Retour</a>
        </div>
    </div>

    <div class="container pb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Liste des employés</span>
                <span class="badge bg-light text-dark"><?= count($liste) ?> employé(s)</span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($liste)): ?>
                    <div class="empty-state">
                        <p>Aucun employé trouvé dans ce département.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="hide-mobile">N° Employé</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Genre</th>
                                    <th class="hide-mobile">Date d'embauche</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($liste as $employee): ?>
                                    <tr>
                                        <td class="hide-mobile"><span class="emp-no">#<?= htmlspecialchars($employee['emp_no']) ?></span></td>
                                        <td> <a href="fiche.php?num_e=<?= htmlspecialchars($employee['emp_no']) ?>"> <?= htmlspecialchars($employee['first_name']) ?></a></td>
                                        <td><strong> <a href="fiche.php?num_e=<?= htmlspecialchars($employee['emp_no']) ?>"> <?= htmlspecialchars($employee['last_name']) ?></a></strong></td>
                                        <td>
                                            <span class="gender-badge gender-<?= htmlspecialchars($employee['gender']) ?>">
                                                <?= $employee['gender'] === 'M' ? 'Homme' : 'Femme' ?>
                                            </span>
                                        </td>
                                        <td class="hide-mobile"><?= htmlspecialchars($employee['from_date']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>