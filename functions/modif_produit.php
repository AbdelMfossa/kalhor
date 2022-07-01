<?php
session_start();

include('connexion.php');
$code = $_POST['code'];

if ( (!empty($_POST["libelle"])) && (!empty($_POST["pu"])) && (!empty($_POST["qte"]))  && (!empty($_POST["code"])) ){

    $libelle = stripslashes(strip_tags($_POST["libelle"]));
    $pu = stripslashes(strip_tags($_POST["pu"]));
    $qte = stripslashes(strip_tags($_POST["qte"]));
    $code = stripslashes(strip_tags($_POST["code"]));

    $query=$db->prepare("UPDATE produit SET libelle = :libelle, prix_unitaire= :pu, qte= :qte WHERE code= :code");
    $query->bindValue(':libelle', $libelle, PDO::PARAM_STR);
    $query->bindValue(':pu', $pu, PDO::PARAM_STR);
    $query->bindValue(':qte', $qte, PDO::PARAM_STR);
    $query->bindValue(':code', $code, PDO::PARAM_STR);
    $query->execute();
    $data = $query->rowCount();
    $query->CloseCursor();

    if(empty($data)){
        echo "<script>alert('Pas de mise à jour effectuée, recommencez..')</script>";
        echo "<script>window.location.replace('../modifier.php?code=$code');</script>";
    }else{
        echo "<script>alert('Modifié avec success..')</script>";
        echo "<script>window.location.replace('../home.php');</script>";
    }
}else{
    echo "<script>alert('Veuillez remplir tous les champs..')</script>";
    echo "<script>window.location.replace('../modifier.php?code=$code');</script>";
}
