<?php

/**
 * 
 * TODO : � compl�ter
 * 
 * Auteur : 
 * Date : 
 * Description :
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
        echo "DB connectée";
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

        //$req = $connector->query('SELECT * FROM Table');
        // TODO: permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
    }

    /**
     * TODO: � compl�ter
     */
    private function queryPrepareExecute($query, $binds){
        
        // TODO: permet de pr�parer, de binder et d�ex�cuter une requ�te (select avec where ou insert, update et delete)
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
     * TODO: � compl�ter
     */
    public function getAllTeachers(){

        // TODO: r�cup�re la liste de tous les enseignants de la BD
        // TODO: avoir la requ�te sql
        // TODO: appeler la m�thode pour executer la requ�te
        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        // TODO: retour tous les enseignants
    }

    /**
     * TODO: � compl�ter
     */
    public function getOneTeacher($id){

        // TODO: r�cup�re la liste des informations pour 1 enseignant
        // TODO: avoir la requ�te sql pour 1 enseignant (utilisation de l'id)
        // TODO: appeler la m�thode pour executer la requ�te
        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        // TODO: retour l'enseignant
    }


    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }


?>