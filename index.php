<?php
// Se connecter via PDO
try{
    $connector = new PDO('mysql:host=localhost:6033;dbname=db_nickname;charset=utf8', 'root', 'root');
    echo "DB connectée";
}
catch (PDOException $e)
{
    die('Erreur :' . $e->getMessage());
}