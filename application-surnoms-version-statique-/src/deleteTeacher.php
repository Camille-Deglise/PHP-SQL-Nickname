<?php
$idTeacher = $_GET["idTeacher"];

include("Database.php");
$db = new Database();

$db->deleteTeacher($idTeacher);

header("Location: index.php");
exit();

?>