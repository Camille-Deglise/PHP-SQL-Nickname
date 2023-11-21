<?php
/**
 * Auteur : Camille Déglise
 * Date : 31.10.2023
 * Description : Fichier HTML-PHP pour afficher les détails d'un enseignant
 * Utilisation de la méthode public getOneTeacher(id)
 * Utilisation de la méthode public getOneSection($tableau[entrée pour la section])
 * Nécessite la récupération de l'ID de l'enseignant depuis $_GET
 */

 //Déclaration dans une variable de l'identifiant de l'enseignant récupéré depuis le $_GET
$idTeacher = $_GET["idTeacher"];

include("Database.php");
//Connexion à la base de donnée via le constructeur de la classe 
$db = new Database();

//Récupération des informations de l'enseignant via la variable $idTeacher
$teacher = $db->getOneTeacher($idTeacher);
$section = $db->getOneSection($teacher["fkSection"]);

//utilise la méthode pour augmenter les votes 
$db->upgradeVote($idTeacher);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/style.css" rel="stylesheet">
    <title>Version statique de l'application des surnoms</title>
</head>

<body>

    <header>
        <div class="container-header">
            <div class="titre-header">
                <h1>Surnom des enseignants</h1>
            </div>
            <div class="login-container">
                <form action="#" method="post">
                    <label for="user"> </label>
                    <input type="text" name="user" id="user" placeholder="Login">
                    <label for="password"> </label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <button type="submit" class="btn btn-login">Se connecter</button>
                </form>
            </div>
        </div>
        <nav>
            <h2>Zone pour le menu</h2>
            <a href="index.php">Accueil</a>
            <a href="addTeacher.php">Ajouter un enseignant</a>
        </nav>
    </header>

    <div class="container">
        <div class="user-head">
            <h3>Détail : <?= $teacher["teaFirstname"] . " " . $teacher["teaName"]?> 
            <?php
            // Conditions pour l'affichage de l'image déterminant le genre de l'enseignant 
                if($teacher["teaGender"] == "M")
                {
                    echo "<img style=\"margin-left: 1vw;\" height=\"20em\" src=\"./img/male.png\" alt=\"male symbole\">";
                }
                elseif($teacher["teaGender"] == "F")
                {
                    echo "<img style=\"margin-left: 1vw;\" height=\"20em\" src=\"./img/femelle.png\" alt=\"femme symbole\">";
                }
                else
                {
                    echo "<img style=\"margin-left: 1vw;\" height=\"20em\" src=\"./img/autre.png\" alt=\"autre symbole\">";
                }
            ?>
                
            </h3>
            <p>
                <!-- Affichage du nom de la section selon l'enseignant -->
                <?= $section["secName"]?> 
            </p>
            <div class="actions">

                <a href="#">
                    <img height="20em" src="./img/edit.png" alt="edit icon"></a>
                <a href="javascript:confirmDelete()">
                    <img height="20em" src="./img/delete.png" alt="delete icon"> </a>

            </div>
        </div>
        <div class="user-body">
            <div class="left">
                <p>Surnom : <?= $teacher["teaNickname"]?></p>
                <p><?= $teacher["teaOrigine"]?></p>
            </div>
        </div>
        <div class="user-footer">
            <p><a href="election.php">J'élis</a></p>
            <p>Nombre de votes reçus :  <?php 
            //Affichage des voix si plus grand que 0 
            if($teacher["teaVoice"] == 0)
            {
                echo "Aucun vote";
            }
            else 
            {
               echo $teacher["teaVoice"];
            }
            
            ?>
            </p>
            <a href="index.php">Retour à la page d'accueil</a>
        </div>

    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

    <script src="js/script.js"></script>

</body>

</html>