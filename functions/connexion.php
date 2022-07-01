<?php

    $hostname = "localhost";
    $username = "tp_ict4d";
    $password = "tp_ict4d";
    $dbname = "tp_ict4d";

    try{
        $db = new PDO('mysql:host='.$hostname.';dbname='.$dbname.'', $username, $password);
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
?>