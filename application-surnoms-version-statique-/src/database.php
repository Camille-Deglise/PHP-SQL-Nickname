<?php

/**
 * Auteur : Camille Déglise
 * Date : 31.10.2023
 * Description : Classe Database contenant toutes les fonctions et méthodes
 * pour la gestion de l'API surnoms des enseignants.
 */


 class Database {

    // Variable de classe
    private $connector;

    /**
     * Fonction pour se connecter via PDO et utiliser la variable de classe $connector
     * Utilise un trycatch pour renvoyer une erreur dans la variable $e
     */
    public function __construct(){
        try{
            $this->connector = new PDO('mysql:host=localhost:6033;dbname=db_nickname;charset=utf8', 'root', 'root');
            //echo "DB connectée";
        }
        catch (PDOException $e)
        {
            die('Erreur :' . $e->getMessage());
        }
    }

    /**
     * Fonction pour exécuter une requête simple en utilisant la méthode query 
     * Utiliser uniquement sans paramètres
     */
    private function querySimpleExecute($query){

        $req = $this->connector->query($query);
        return $req;
    }

    /**
     * Fonction pour exéctuer une requête avec des concaténations
     * Importance d'utiliser le prépare car protections contre injections SQL
     */
    private function queryPrepareExecute($query, $binds){
        
        $req = $this->connector->prepare($query);
        foreach($binds as $bind) {
            $req->bindValue($bind[0], $bind[1], $bind[2]);
        }
        $req->execute();
        return $req;
    }

    /**
     * Méthode pour traiter les données pour les retourner 
     * en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req){
        return $req->fetchALL(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode qui récupère la liste de tous les enseignants de la BD
     */
    public function getAllTeachers()
    {
        // Récupère les données sur la table enseignants avec une requête sql
        $query = "SELECT * FROM t_teacher;";

       //appeler la méthode pour executer la requête
        $req = $this->querySimpleExecute($query);

        //Retourne dans un tableau les données des enseignants
        $teachers = $this->formatData($req);
        
        return $teachers;

    }
    /*
    *Méthode pour récupérer toutes les sections présentes dans la base de données
    *Utilisée dans le addTeacher, updateTeacher. 
    */
    public function getAllSections()
    {
        // Récupère les données sur la table enseignants avec une requête sql
        $query = "SELECT * FROM t_section;";

       //appeler la méthode pour executer la requête
        $req = $this->querySimpleExecute($query);

        //Retourne dans un tableau les données des enseignants
        $sections = $this->formatData($req);
        
        return $sections;
    }

    /**
     * Méthode qui récupère la liste des informations pour 1 enseignant
     * Prend en argument l'ID de l'enseignant
     * Doit être associée à un $_GET dans la page concernée
     */
    public function getOneTeacher($id){
        // Récupère les données sur la table enseignants avec une requête sql
        // en utilisant son ID
        $query = "SELECT * FROM t_teacher WHERE idTeacher = :id"; 
        $binds = [
            ['id', $id, PDO::PARAM_INT]
        ];

        //appeler la méthode pour executer la requête
        $req = $this->queryPrepareExecute($query,$binds);

        //Retourne dans un tableau associatif à une seule 
        //entrée les données d'un enseignant
        $teacher =$this->formatData($req);
        
        //Retourne la première (et unique) entrée du tableau
        return $teacher[0];
    }


    /**
     *Méthode qui récupère dans la liste des informations pour 1 section
     *Prend en arguement l'ID de la section
     *Le $_GET n'est pas nécessaire car l'information sera récupérée directement 
     *dans le $_GET de l'enseignant avec la fkSection
     */

     public function getOneSection($idSec)
     {
        //Récupère les données sur la table section avec une requête sql
        $query = "SELECT * FROM t_section WHERE idSection = :id";
        $binds = [
            ['id', $idSec, PDO::PARAM_INT]
        ];
        //MODIFIER EN PREPARE
        //appeler la méthode pour exécuter la requête
        $req = $this->queryPrepareExecute($query, $binds);

        //Retourne dans un tableau associatif les données de section
        $section = $this->formatData($req);

        return $section[0];

     }
    /**
     * Méthode pour insérer les données d'un nouvel enseignsant 
     * Prend en argument les données du $_POST de la page qui l'appelle
     */
    public function addTeacher($data)
    {
        //Ajout des données de $_POST ($data) dans de nouvelles variables
        //pour des questions de lisibilité. 
        $firstName = $data["firstName"];
        $lastname = $data["name"];
        $gender = $data["genre"];
        $nickName = $data["nickName"];
        $origin = $data["origin"];
        $fkSection = $data["section"];

        //Requête sur la db pour insérer les nouvelles données avec prepare
        //:xxx == étiquette 
        $query = "INSERT INTO t_teacher (teaFirstName, teaName, teaGender, 
        teaNickname, teaOrigine, fkSection)
        VALUES(:firstName, :lastname, :gender, :nickName, :origin, :section)";

        //Liasion des variables avec le marqueur 
        $binds = [
            ['firstName', $firstName, PDO::PARAM_STR],
            ['lastname', $lastname, PDO::PARAM_STR],
            ['gender', $gender, PDO::PARAM_STR],
            ['nickName', $nickName, PDO::PARAM_STR],
            ['origin', $origin, PDO::PARAM_STR],
            ['section', $fkSection, PDO::PARAM_INT],
        ];
        $this->queryPrepareExecute($query, $binds);

    }
    /**
     * Méthode pour modifier les données d'un enseignant déjà existant
     * Prend en arguement les données du $_POST de la page qui l'appelle
     * Fonctionne avec un prepare-query
     */

    public function updateTeacher($data)
    {
         //Ajout des données de $_POST ($data) dans de nouvelles variables
        //pour des questions de lisibilité. 
        $firstName = $data["firstName"];
        $lastname = $data["name"];
        $gender = $data["genre"];
        $nickName = $data["nickName"];
        $origin = $data["origin"];
        $fkSection = $data["section"];

         //Requête sur la db pour modifier les nouvelles données avec prepare
        //:xxx == étiquette 
        $query = "UPDATE t_teacher
                  SET teaFirstName = :firstName, 
                      teaName = :lastname, 
                      teaGender = :gender,
                      teaNickname = :nickName, 
                      teaOrigine = :origin, 
                      fkSection = :section
                  WHERE idTeacher = ". $data['idTeacher'] . ";";
        
        //Liasion des variables avec le marqueur 
        $binds = [
            ['firstName', $firstName, PDO::PARAM_STR],
            ['lastname', $lastname, PDO::PARAM_STR],
            ['gender', $gender, PDO::PARAM_STR],
            ['nickName', $nickName, PDO::PARAM_STR],
            ['origin', $origin, PDO::PARAM_STR],
            ['section', $fkSection, PDO::PARAM_INT],
        ];
        $this->queryPrepareExecute($query, $binds);
    }
    /**
     * Fonction pour supprimer dans la base de donnée un enseignant 
     * Prend en paramètre l'ID de l'enseignant sélectionné 
     */
    public function deleteTeacher($id)
    {
        $query = "DELETE FROM t_teacher WHERE idTeacher = :id";
        $binds = [
            ['id', $id, PDO::PARAM_INT]
        ];
        $this->queryPrepareExecute($query, $binds);
        
    }
     /*******************************************************************************************************************************************/
     private function addUser()
     {
        $query = "INSERT INTO t_user VALUES (";
     }

 }
?>