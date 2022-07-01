<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projet";

    try{
        $db = new PDO('mysql:host='.$hostname.';dbname='.$dbname.'', $username, $password);
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
?>