<?php 
/**
 * Auteur : Camille Déglise
 * Date : 21.11.2023
 * Description : Fichier PHP pour les éléctions de surnoms des enseignants
 * Utilisation de la méthode public upgradeVote en utilisant le idTeacher récupéré via le $_GET
 */
 //Déclaration dans une variable de l'identifiant de l'enseignant récupéré depuis le $_GET

 $idTeacher = $_GET["idTeacher"];

 include("Database.php");
 $db = new Database();
 
 $db->upgradeVote($idTeacher);

 header("Location:index.php");
 exit();
 