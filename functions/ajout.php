<?php

include('connexion.php');

if ( (!empty($_POST["code"])) && (!empty($_POST["libelle"])) && (!empty($_POST["pu"]))  && (!empty($_POST["qte"])) ){

    $code = stripslashes(strip_tags($_POST["code"]));
    $libelle = stripslashes(strip_tags($_POST["libelle"]));
    $pu = stripslashes(strip_tags($_POST["pu"]));
    $qte = stripslashes(strip_tags($_POST["qte"]));

    $query=$db->prepare("INSERT INTO produit(code, libelle, prix_unitaire, qte) VALUES (:code, :libelle, :pu, :qte)");
    $query->bindValue(':code', $code, PDO::PARAM_STR);
    $query->bindValue(':libelle', $libelle, PDO::PARAM_STR);
    $query->bindValue(':pu', $pu, PDO::PARAM_STR);
    $query->bindValue(':qte', $qte, PDO::PARAM_STR);
    $query->execute();
    $data = $query->rowCount();
    $query->CloseCursor();

    if(empty($data)){
        echo "<script>alert('Un problème est survenu, recommencez..')</script>";
        echo "<script>window.location.replace('../ajout_produit.php');</script>";
    }else{
        echo "<script>alert('Ajouté avec success..')</script>";
        echo "<script>window.location.replace('../home.php');</script>";
    }
}else{
    echo "<script>alert('Veuillez remplir tous les champs..')</script>";
    echo "<script>window.location.replace('../ajout_produit.php');</script>";
}
