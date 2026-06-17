<?php 
    include_once 'functions.php';
    session_start();
    $num_e = $_SESSION["num_e"];

    $name_dept = $_POST["departement"];

    $date = $_POST["Datedebut"];

    $id = getIddepartement($name_dept);

    $check = ChangeDepartments($num_e,$name_dept,$date);
    // echo $id;
// 10017
if($check == 1){
    echo "success";
}else if ($check == 2){
    echo "date doit etre superieur a la date actuelle";
}else{
    echo "echec";
}


?>