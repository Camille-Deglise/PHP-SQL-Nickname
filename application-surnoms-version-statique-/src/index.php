<?php 
/**
 * Auteur : Camille Déglise
 * Date : 31.10.2023
 * Description : Fichier HTML-PHP pour la page d'accueil du site
 * Utilisation de la méthode public getAllTeachers() pour afficher les enseignants
 * Possibilité de modifier, supprimer ou consulter les données d'un enseigant
 * Possibilité de se loguer PAS FONCTIONNEL (20.11.2023)
 */
//session_start();
//session_destroy();
include("Database.php");

//Connexion à la base de donnée via le constructeur de la classe 
$db = new Database();
$teachers = $db->getAllTeachers();


//echo "<pre>";
//var_dump($teachers);
//echo "</pre>";

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
                <form action="verifyLogin.php" method="post">
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
        <h3>Liste des enseignants</h3>
        <button type="submit" id="plusieurs">Elire plusieurs</button>
        <form action="#" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Surnom</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //Affichage des enseignants sous forme de tableau html
                    $html = "";
                    foreach($teachers as $teacher) {

                        $html .= "<tr>";
                        $html .= "<td> <input type=\"checkbox\" id=\"elu\"/>";
                        $html .= "<td>" . $teacher["teaFirstname"] . " " . $teacher["teaName"] . "</td>";
                        $html .= "<td>" . $teacher["teaNickname"] . "</td>";
                        $html .= "<td class=\"containerOptions\">";
                        
                        $html .= "<a href=\"./updateTeacher.php?idTeacher=" .  $teacher["idTeacher"] . "\">";
                        $html .= "<img height=\"20em\" src=\"./img/edit.png\" alt=\"edit\">";
                        $html .= "</a>";
                        $html .= "<a onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer l\'enseignant ?')\" href=\"./deleteTeacher.php?idTeacher=" .  $teacher["idTeacher"] . "\">";
                        $html .= "<img height=\"20em\" src=\"./img/delete.png\" alt=\"delete\">";
                        $html .= "</a>";
                        $html .= "<a href=\"./detailTeacher.php?idTeacher=" .  $teacher["idTeacher"] . "\">";
                        $html .= "<img height=\"20em\" src=\"./img/detail.png\" alt=\"detail\">";
                        $html .= "</a>";
                        $html .= "<a href= \"election.php?idTeacher=" . $teacher["idTeacher"] . "\">J'élis</a>";
                        //affichage des voix si + grd que 0 
                        if($teacher["teaVoice"]> 0)
                        {
                            $html .= " " . $teacher["teaVoice"];
                        }
                        else
                        {
                            $html .= " Aller ! Voter pour moi ";
                        }
                        
                        $html .= "</td>";
                        $html .= "</tr>";
                    }

                    echo $html;
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

</body>

</html>