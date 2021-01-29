<?php
// Jiazheng Huang

include 'DatabaseAdaptor.php';

$theDBA = new DatabaseAdaptor();

if ($_GET['tableName'] === "Actors"){
    echo json_encode($theDBA->getAllActors($_GET['substring']));
//     echo json_encode($theDBA->getAllActors('will'));
}
elseif ($_GET['tableName'] === "Movies") {
    echo json_encode($theDBA->getAllMovies($_GET['substring']));
//     echo json_encode($theDBA->getAllMovies('A'));
}
elseif ($_GET['tableName'] === "Roles") {
    echo json_encode($theDBA->getAllRoles($_GET['substring']));
//     echo json_encode($theDBA->getAllRoles('Blut'));
}
?>