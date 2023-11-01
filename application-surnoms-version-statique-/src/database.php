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
     */    private function querySimpleExecute($query){

        $req = $this->connector->query('SELECT * FROM Table');
        
    }

    /**
     * Fonction pour exéctuer une requête avec des concaténations
     * Importance d'utiliser le prépare car protections contre injections SQL
     */
    private function queryPrepareExecute($query, $binds){
        
        // $req = $connector->prepare('SELECT * FROM Table WHERE id = :varId AND input = :varInput');
        //$req->bindValue('varId', $id, PDO::PARAM_INT);
        //$req->bindValue('varInput', $input, PDO::PARAM_STR);
        //$req->execute();
    }

    /**
     * TODO: � compl�ter
     */
    private function formatData($req){

        // TODO: traiter les donn�es pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
    }

    /**
     * TODO: � compl�ter
     */
    private function unsetData($req){

        // TODO: vider le jeu d�enregistrement
    }

    /**
     * Méthode qui récupère la liste de tous les enseignants de la BD
     */
    public function getAllTeachers()
    {
        // Récupère les données sur la table enseignants avec une requête sql
        $query = "SELECT * FROM t_teacher;";

       //appeler la méthode pour executer la requête
        $req = $this->connector->query($query);

        //Retourne dans un tableau les données des enseignants
        $teachers = $req->fetchALL(PDO::FETCH_ASSOC);
        
        return $teachers;

    }

    /**
     * Méthode qui récupère la liste des informations pour 1 enseignant
     * Prend en argument l'ID de l'enseignant
     * Doit être associée à un $_GET dans la page concernée
     */
    public function getOneTeacher($id){

        // Récupère les données sur la table enseignants avec une requête sql
        // en utilisant son ID
        $query = "SELECT * FROM t_teacher WHERE idTeacher = $id;"; // faire un join pour récupérer le nom de la section au lieu de l'ID

        //MODIFIER EN PREPARE
       //appeler la méthode pour executer la requête
        $req = $this->connector->query($query);

        //Retourne dans un tableau associatif à une seule 
        //entrée les données d'un enseignant
        $teacher = $req->fetchALL(PDO::FETCH_ASSOC);
        
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
        $query = "SELECT * FROM t_section WHERE idSection = $idSec";

        //MODIFIER EN PREPARE
        //appeler la méthode pour exécuter la requête
        $req = $this->connector->query($query);

        //Reourne dans un tableau associatif les données de section
        $section = $req->fetchALL(PDO::FETCH_ASSOC);

        return $section[0];

     }
    /**
     * Méthode pour insérer les données d'un nouvel enseignsant 
     */
    public function addTeacher()
    {

    }
 }


?>