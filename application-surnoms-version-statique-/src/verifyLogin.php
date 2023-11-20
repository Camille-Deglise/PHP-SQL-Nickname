<?php
/**
 * Auteur : Camille Déglise
 * Date : 31.10.2023
 * Description : Fichier PHP pour la gestion de vérification du login 
 */
session_start();
$dataUser = $_POST;
//var_dump($_SESSION);
include("Database.php");
$db = new Database();
$db->verifyLoginAndPassword($dataUser);

?>