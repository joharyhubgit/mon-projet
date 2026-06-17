<?php
include 'functions.php';
$nb_employees = gettablenbemployeesparsexe();
$salaire_moyenne = gettablesalaireparemploi();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <div class="top-bar">
        <div class="container">
            <h1>Statistiques des employés</h1>
        </div>
    </div>

    <div class="container pb-5">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Nombre d'employés par sexe</span>
                <span class="badge bg-light text-dark"><?= count($nb_employees) ?> genre(s)</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Genre</th>
                                <th>Nombre d'employés</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nb_employees as $employees): ?>
                                <tr>
                                    <td><?= htmlspecialchars($employees['gender']) ?></td>
                                    <td><span class="badge-date"><?= htmlspecialchars($employees['nb_employees']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Salaire moyen par poste</span>
                <span class="badge bg-light text-dark"><?= count($salaire_moyenne) ?> poste(s)</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Poste</th>
                                <th>Salaire Moyen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($salaire_moyenne as $salaire): ?>
                                <tr>
                                    <td><?= htmlspecialchars($salaire['title']) ?></td>
                                    <td><span class="badge-date"><?= number_format($salaire['salaire_moyen'], 2) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="index.php" class="dept-link mt-3 d-inline-block">← Retour à la liste des départements</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>