<?php
function dbconnect()
{
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'employees');
        if (!$connect) {
            die('erreur de connexion a la base de donnee : ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}

function getAllDepartements()
{
    $db = dbconnect();
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($db, $sql);
    $nb_employees = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nb_employees[] = $row;
        }
    }
    return $nb_employees;
}

function getDepartmentswithcoll()
{
    $db = dbconnect();
    $sql = "SELECT      departments.dept_no,     departments.dept_name,     employees.emp_no,     dept_manager.from_date,     dept_manager.to_date,     employees.birth_date,     employees.first_name,     employees.last_name,     employees.gender,     employees.hire_date, tablecount.nb_employees FROM departments JOIN dept_manager ON departments.dept_no = dept_manager.dept_no JOIN employees ON dept_manager.emp_no = employees.emp_no join(select dept_no, count(dept_emp.emp_no) as nb_employees from dept_emp group by dept_no) as tablecount on departments.dept_no = tablecount.dept_no where dept_manager.to_date='9999-01-01' order by departments.dept_no ASC";
    $result = mysqli_query($db, $sql);
    $nb_employees = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nb_employees[] = $row;
        }
    }
    return $nb_employees;
}

function getAllEmployeesinDept($num)
{
    $db = dbconnect();
    $sql = "SELECT employees.* FROM employees JOIN dept_emp ON employees.emp_no = dept_emp.emp_no JOIN departments ON dept_emp.dept_no = departments.dept_no WHERE departments.dept_no = '%s'";
    $sql = sprintf($sql, $num);
    $result = mysqli_query(dbconnect(), $sql);
    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
    return $employees;
}

function getInfoEmployee($num)
{
    $db = dbconnect();
    $sql = "SELECT * FROM employees WHERE employees.emp_no = '%s'";
    $sql = sprintf($sql, $num);
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

function getHisSalary($num)
{
    $db = dbconnect();
    $sql = "SELECT salary, s.from_date, s.to_date
FROM employees e
JOIN salaries s ON s.emp_no = e.emp_no
WHERE e.emp_no = '%s'
ORDER BY s.from_date";
    $sql = sprintf($sql, $num);
    $result = mysqli_query(dbconnect(), $sql);
    $salaries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $salaries[] = $row;
    }
    return $salaries;
}

function getHispost($num)
{
    $db = dbconnect();
    $sql = "SELECT title, t.from_date, t.to_date
FROM employees e
JOIN titles t ON t.emp_no = e.emp_no
WHERE e.emp_no = '%s'
ORDER BY t.from_date;";
    $sql = sprintf($sql, $num);
    $result = mysqli_query(dbconnect(), $sql);
    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}
function rechercheDepartement($nomdepartement)
{
    $sql = "SELECT * FROM departments WHERE dept_name LIKE '%%%s%%' LIMIT 20";
    $sql = sprintf($sql, $nomdepartement);
    $result = mysqli_query(dbconnect(), $sql);
    $nb_employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nb_employees[] = $row;
    }
    return $nb_employees;
}
function rechecheEmploye($nom)
{
    $sql = "SELECT * FROM employees WHERE first_name LIKE '%%%s%%' OR last_name LIKE '%%%s%%' LIMIT 20";
    $sql = sprintf($sql, $nom, $nom);
    $result = mysqli_query(dbconnect(), $sql);
    $employes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employes[] = $row;
    }
    return $employes;
}
function rechercheAge($ageMin, $ageMax)
{
    $sql = "SELECT * FROM employees WHERE birth_date BETWEEN DATE_SUB(CURDATE(), INTERVAL %d YEAR) AND DATE_SUB(CURDATE(), INTERVAL %d YEAR) LIMIT 20";
    $sql = sprintf($sql, $ageMax, $ageMin);
    $result = mysqli_query(dbconnect(), $sql);
    $employes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employes[] = $row;
    }
    return $employes;
}

function searchEmployeByNameAndAge($name, $ageMin, $ageMax)
{
    if ($name == null) {
        $name = '';
    } else if ($ageMin == null && $ageMax == null) {
        $ageMin = 0;
        $ageMax = 100;
    }
    $sql = "SELECT * FROM employees WHERE (first_name LIKE '%%%s%%' OR last_name LIKE '%%%s%%') AND birth_date BETWEEN DATE_SUB(CURDATE(), INTERVAL %d YEAR) AND DATE_SUB(CURDATE(), INTERVAL %d YEAR) LIMIT 20";
    $sql = sprintf($sql, $name, $name, $ageMax, $ageMin);
    $result = mysqli_query(dbconnect(), $sql);
    $employes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employes[] = $row;
    }
    return $employes;
}

function gettablenbemployeesparsexe()
{
    $db = dbconnect();
    $sql = "SELECT gender, COUNT(emp_no) AS nb_employees FROM employees GROUP BY gender";
    $result = mysqli_query($db, $sql);
    $nb_employees = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nb_employees[] = $row;
        }
    }
    return $nb_employees;
}

function gettablesalaireparemploi()
{
    $db = dbconnect();
    $sql = "SELECT title, AVG(salary) AS salaire_moyen FROM salaries JOIN titles ON salaries.emp_no = titles.emp_no GROUP BY title ORDER BY salaire_moyen DESC";
    $result = mysqli_query($db, $sql);
    $salaire = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $salaire[] = $row;
        }
    }
    return $salaire;
}
