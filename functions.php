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

function getAllDepartements(){
    $db = dbconnect();
    $sql = "SECELECT * FROM departments";
    $result = mysqli_query($db, $sql);
    $departements = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departements[] = $row;
        }
    }
    return $departements;   

}

?>