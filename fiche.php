<?php
include 'functions.php';
$num_e = $_GET['num_e'];
$employee = getInfoEmployee($num_e);
$salaries = getHisSalary($num_e);
$postes = getHispost($num_e);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche — <?= htmlspecialchars($employee['first_name']) ?> <?= htmlspecialchars($employee['last_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Fiche employé
                <span class="dept-badge">#<?= htmlspecialchars($employee['emp_no']) ?></span>
            </h1>
            <a href="javascript:history.back()" class="btn-back">&#8592; Retour</a>
        </div>
    </div>

    <div class="container pb-5">

        <div class="card mb-4">
            <div class="card-header">Informations personnelles</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                        <tr><td class="fw-semibold">N° Employé</td><td><span class="emp-no">#<?= htmlspecialchars($employee['emp_no']) ?></span></td></tr>
                        <tr><td class="fw-semibold">Prénom</td><td><?= htmlspecialchars($employee['first_name']) ?></td></tr>
                        <tr><td class="fw-semibold">Nom</td><td><?= htmlspecialchars($employee['last_name']) ?></td></tr>
                        <tr>
                            <td class="fw-semibold">Genre</td>
                            <td>
                                <span class="gender-badge gender-<?= htmlspecialchars($employee['gender']) ?>">
                                    <?= $employee['gender'] === 'M' ? 'Homme' : 'Femme' ?>
                                </span>
                            </td>
                        </tr>
                        <tr><td class="fw-semibold">Date de naissance</td><td><?= htmlspecialchars($employee['birth_date']) ?></td></tr>
                        <tr><td class="fw-semibold">Date d'embauche</td><td><?= htmlspecialchars($employee['hire_date']) ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Historique des salaires</span>
                        <span class="badge bg-light text-dark"><?= count($salaries) ?> entrée(s)</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Salaire</th>
                                        <th>Du</th>
                                        <th>Au</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($salaries as $salary): ?>
                                    <tr>
                                        <td><span class="emp-no"><?= htmlspecialchars($salary['salary']) ?></span></td>
                                        <td><?= htmlspecialchars($salary['from_date']) ?></td>
                                        <td><?= htmlspecialchars($salary['to_date']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Historique des postes</span>
                        <span class="badge bg-light text-dark"><?= count($postes) ?> entrée(s)</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Du</th>
                                        <th>Au</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($postes as $post): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($post['title']) ?></strong></td>
                                        <td><?= htmlspecialchars($post['from_date']) ?></td>
                                        <td><?= htmlspecialchars($post['to_date']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>