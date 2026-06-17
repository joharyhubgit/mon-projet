# To-Do List

## Installation & Organisation
- [ok] Créer le fichier functions.php (connexion + toutes les fonctions)
- [ok] Créer style.css avec variables CSS et responsive mobile

## Fonctions (functions.php)
- [ok] dbconnect() — connexion à la base de données
- [ok] getAllDepartements() — liste tous les départements
- [ok] getDepartmentswithcoll() — liste les départements avec manager en cours et nombre d'employés
- [ok] getAllEmployeesinDept($num) — liste les employés d'un département
- [ok] getInfoEmployee($num) — informations d'un employé
- [ok] getHisSalary($num) — historique des salaires d'un employé
- [ok] getHispost($num) — historique des postes d'un employé
- [ok] rechercheDepartement($nomdepartement) — recherche un département par nom
- [ok] rechecheEmploye($nom) — recherche un employé par nom
- [ok] rechercheAge($ageMin, $ageMax) — recherche des employés par âge
- [ok] searchEmployeByNameAndAge($name, $ageMin, $ageMax) — recherche combinée nom + âge
- [ok] gettablenbemployeesparsexe() — nombre d'employés par sexe
- [ok] gettablesalaireparemploi() — salaire moyen par poste

## Pages créées
- [ok] index.php — liste des départements avec manager et nombre d'employés
- [ok] traitement.php — liste des employés d'un département
- [ok] fiche.php — fiche détaillée d'un employé
- [ok] nb_employees.php — statistiques (nombre par sexe + salaire moyen par poste)
- [ok] traitement_recherche.php — page de résultats de recherche
- [ok] style.css — style complet avec variables CSS et responsive mobile

## Version 1
- [ok] Créer une page qui affiche la liste des départements
- [ok] Rajouter une colonne qui affiche le nom du manager en cours
- [ok] Mettre un lien sur chaque ligne de département pour afficher dans une autre page la liste des employés de ce département

## Version 2
- [ok] Lorsqu'on clique sur un employé, on doit afficher la fiche de l'employé
- [ok] Rajouter l'historique du salaire et de l'emploi occupé dans la fiche
- [ok] Créer un formulaire de recherche ( departement, nom employé, age min et max )
- [ok] Afficher seulement 20 lignes (utiliser LIMIT en SQL)
- [ ] Créer un lien suivant pour afficher les 20 prochaines lignes
- [ ] Créer un lien précédent pour afficher les 20 lignes précédentes

## Version 3
- [ok] Ajouter une colonne nombre employé sur la liste des départements
- [ok] Créer une page pour afficher un tableau contenant le nombre d'employé (homme et femme), et le salaire moyen pour chaque emploi
- [ ] Dans la fiche employé, mettre l'emploi le plus long (en terme de date)

## Version 4
- [ok] Dans la fiche de l'employé, mettre un bouton "changer de département" qui ouvre un formulaire (choix département, date de début)
- [ok] Vérifier que le nouveau département s'affiche bien après l'ajout
- [ok] Mettre en haut du formulaire le département actuel avec la date de début (ne pas mettre le département actuel dans la liste)
- [ok] Mettre un message d'erreur si la date de début du nouveau département est antérieure à la date de début de l'actuel
- [ok] Dans la fiche de l'employé, mettre un bouton "Devenir Manager" qui ouvre un formulaire (Date de début)
- [ok] Vérifier dans la liste des départements qu'il est bien le nouveau manager
- [ok] Mettre en haut du formulaire le nom du manager en cours
- [ok] Mettre un message d'erreur si la date de début du nouveau manager est antérieure à la date de début de l'actuel
