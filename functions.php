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
    $departements = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departements[] = $row;
        }
    }
    return $departements;
}

function getDepartmentswithcoll()
{
    $db = dbconnect();
    $sql = "SELECT      departments.dept_no,     departments.dept_name,     employees.emp_no,     dept_manager.from_date,     dept_manager.to_date,     employees.birth_date,     employees.first_name,     employees.last_name,     employees.gender,     employees.hire_date FROM departments JOIN dept_manager ON departments.dept_no = dept_manager.dept_no JOIN employees ON dept_manager.emp_no = employees.emp_no where dept_manager.to_date='9999-01-01' order by departments.dept_no ASC";
    $result = mysqli_query($db, $sql);
    $departements = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departements[] = $row;
        }
    }
    return $departements;
}
function getManagerActuel($dept_no)
{
    $conn = dbconnect();
    $sql = "SELECT employees.first_name, employees.last_name, dept_manager.from_date 
            FROM dept_manager
            JOIN employees ON employees.emp_no = dept_manager.emp_no
            WHERE dept_manager.dept_no = '%s' 
            AND dept_manager.to_date = '9999-01-01'";
    $sql = sprintf($sql, $dept_no);
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
function getAllEmployeesinDept($num)
{
    $db = dbconnect();
    $sql = "SELECT employees.*,dept_emp.* FROM employees JOIN dept_emp ON employees.emp_no = dept_emp.emp_no JOIN departments ON dept_emp.dept_no = departments.dept_no WHERE departments.dept_no = '%s'";
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
    $departements = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departements[] = $row;
    }
    return $departements;
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
function getIddepartement($nom_dept)
{
    $sql = "select dept_no from departments where dept_name='%s'";
    $sql = sprintf($sql, $nom_dept);
    $query = mysqli_query(dbconnect(), $sql);
    $resultat = mysqli_fetch_assoc($query);
    return $resultat['dept_no'];
}

function getNamedept($dept_no)
{
    $sql = "select dept_name from departments where dept_no='%s'";
    $sql = sprintf($sql, $dept_no);
    $query = mysqli_query(dbconnect(), $sql);
    $resultat = mysqli_fetch_assoc($query);
    return $resultat['dept_name'];
}


function getactualdept($dept_no, $emp_no)
{
    $sql = "SELECT * from dept_emp where dept_no='%s' and emp_no='%s'";
    $sql = sprintf($sql, $dept_no, $emp_no);
    $resultat1 = mysqli_query(dbconnect(), $sql);
    $resultat = [];
    while ($row = mysqli_fetch_assoc($resultat1)) {
        $resultat[] = $row;
    }
    return $resultat;
}
function ChangeDepartments($num_e, $nom_dept, $dateDebut)
{
    $sql_before = "SELECT from_date FROM dept_emp WHERE emp_no = '%d' AND to_date = '9999-01-01' ORDER BY from_date DESC LIMIT 1";
    $sql_before = sprintf($sql_before, $num_e);
    $result = mysqli_query(dbconnect(), $sql_before);
    $row = mysqli_fetch_assoc($result);
    $date_actu = $row['from_date'];

    if (strtotime($dateDebut) <= strtotime($date_actu)) {
        return 2;
    } else {
        $id_dept = getIddepartement($nom_dept);
        $sql = "INSERT into dept_emp(emp_no,dept_no,from_date,to_date) values ('%d','%s','%s','9999-01-01')";
        $sql = sprintf($sql, $num_e, $id_dept, $dateDebut);
        $query = mysqli_query(dbconnect(), $sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
} 

function isDejaManager($emp_no, $dept_no) {
    $conn = dbconnect();
    $sql = sprintf(
        "SELECT emp_no FROM dept_manager 
         WHERE emp_no = %d 
         AND dept_no = '%s'
         AND to_date = '9999-01-01'",
        $emp_no, $dept_no
    );
    return mysqli_num_rows(mysqli_query($conn, $sql)) > 0;
}

function insertNouveauManager($emp_no, $dept_no, $dateDebut) {
    $conn = dbconnect();

    $sqlUpdate = "UPDATE dept_manager 
                  SET to_date = '%s' 
                  WHERE dept_no = '%s' 
                  AND to_date = '9999-01-01'";
    $sqlUpdate = sprintf($sqlUpdate, $dateDebut, $dept_no);
    mysqli_query($conn, $sqlUpdate);

    $sqlInsert = "INSERT INTO dept_manager (emp_no, dept_no, from_date, to_date) 
                  VALUES (%d, '%s', '%s', '9999-01-01')";
    $sqlInsert = sprintf($sqlInsert, $emp_no, $dept_no, $dateDebut);
    return mysqli_query($conn, $sqlInsert);
}


