<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";
$errors = array();

//Validation des données

//Vérification du genre
if(!isset($_POST["genre"]) && ($_POST["genre"] !== "M" 
    ||$_POST["genre"] !== "F" ||$_POST["genre"] !== "A")){
    $errors[] = "Le champ GENRE doit être rempli";
}

//Vérification du prénom 
if(!isset($_POST["firstName"]) && ($_POST["firstName"] == ""
|| ctype_alpha($_POST["firstName"])))
{
    $errors[] = "Le champ prénom est obligaoire";
}

//Vérification du nom 
if(!isset($_POST["name"]) && ( $_POST["name"] == ""
|| ctype_alpha($_POST["name"])))
{
    $errors[] = "Le champ nom est obligaoire";
}

//Vérification du surnom
if(!isset($_POST["nickName"]) || $_POST["nickName"] == "")
{
    $errors[] = "Le champ surnom est obligaoire";
}

//Vérification de l'origine
if(!isset($_POST["origin"]) || $_POST["origin"] == "")
{
    $errors[] = "Le champ origine est obligaoire";
}
if(!isset($_POST["section"]) && ($_POST["section"] != "info" 
 || $_POS["section"] != "bois") )
 {
    $errors[] = "Le champ origine est obligaoire";
 }


 if (count($errors) > 0)
{
    foreach($errors as $error) {
        echo $error . "<br>";
    }
}
else 
{
    //méthode pour implémenter les données de la session dans 
    //la base de données 

    include("database.php");
    $db = new Database();
    $db->updateTeacher($_POST);

    header('location: index.php');
    exit();
}