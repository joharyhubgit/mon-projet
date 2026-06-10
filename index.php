<?php 
require_once 'functions.php';
$departements = getDepartmentswithcoll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des départements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <div class="top-bar">
        <div class="container">
            <h1>Gestion des départements</h1>
        </div>
    </div>

    <div class="container pb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Tous les départements</span>
                <span class="badge bg-light text-dark"><?= count($departements) ?> département(s)</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Département</th>
                                <th>Manager</th>
                                <th class="hide-mobile">Date de début</th>
                                <th class="hide-mobile">Date de fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departements as $departement) : ?>
                                <tr>
                                    <td>
                                        <a href="traitement.php?dept_num=<?= $departement['dept_no'] ?>" class="dept-link">
                                            <?= htmlspecialchars($departement['dept_name']) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($departement['first_name'] . ' ' . $departement['last_name']) ?></td>
                                    <td class="hide-mobile"><span class="badge-date"><?= htmlspecialchars($departement['from_date']) ?></span></td>
                                    <td class="hide-mobile"><span class="badge-date"><?= htmlspecialchars($departement['to_date']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>