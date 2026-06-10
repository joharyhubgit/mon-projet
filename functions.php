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
