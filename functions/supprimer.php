<?php
session_start();

include('connexion.php');

if (!empty($_GET["code"])){

    $code = $_GET['code'];

    $query=$db->prepare("DELETE FROM produit WHERE code = :code");
    $query->bindValue(':code', $code, PDO::PARAM_STR);
    $query->execute();
    // $data = $query->rowCount();
    $query->CloseCursor();

    // if(empty($data)){
    //     echo "<script>alert('Pas de mise à jour effectuée, recommencez..')</script>";
    //     echo "<script>window.location.replace('../modifier.php?code=$code');</script>";
    // }else{
        echo "<script>alert('Produit supprimé avec success..')</script>";
        echo "<script>window.location.replace('../home.php');</script>";
    // }
}else{
    echo "<script>alert('Veuillez selectionner le produit..')</script>";
    echo "<script>window.location.replace('../home.php');</script>";
}