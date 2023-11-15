<?php
/**
 * Auteur : Camille Déglise
 * Date : 31.10.2023
 * Description : Fichier HTML-PHP pour la suppression d'un enseignant dans la db
 * Utilisation de la méthode public deleteTeacher(id)
 * Nécessite la récupération de l'ID de l'enseignant depuis le $_GET
 */
$idTeacher = $_GET["idTeacher"];

include("Database.php");
$db = new Database();

$db->deleteTeacher($idTeacher);

header("Location: index.php");
exit();

?>