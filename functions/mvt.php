<?php
session_start();
include('connexion.php');

if ( (!empty($_POST["produit"])) && (!empty($_POST["qte"])) && (!empty($_POST["date"]))  && (!empty($_POST["type"])) ){

    $produit = stripslashes(strip_tags($_POST["produit"]));
    $qte_mvt = stripslashes(strip_tags($_POST["qte"]));
    $date = stripslashes(strip_tags($_POST["date"]));
    $type = stripslashes(strip_tags($_POST["type"]));

    $query=$db->prepare("SELECT * FROM produit WHERE code = :code");
    $query->bindValue(':code', $produit, PDO::PARAM_STR);
    $query->execute();
    $data = $query->fetch();
    $query->CloseCursor();

    // Verifier si le produit est disponible en cas de sortie
    if ($type === "Sortie"){
        
        if ($qte_mvt <= $data['qte']) {
            $query=$db->prepare("UPDATE produit SET qte= :qte WHERE code= :code");
            $query->bindValue(':qte', $data['qte'] - $qte_mvt, PDO::PARAM_INT);
            $query->bindValue(':code', $produit, PDO::PARAM_STR);
            $query->execute();
            $query->CloseCursor();

            $query=$db->prepare("INSERT INTO mouvement(qte_mvt, date, nature, code, username) VALUES (:qte, :date, :nature, :produit, :username)");
            $query->bindValue(':qte', $qte_mvt, PDO::PARAM_INT);
            $query->bindValue(':date', $date, PDO::PARAM_STR);
            $query->bindValue(':nature', $type, PDO::PARAM_STR);
            $query->bindValue(':produit', $produit, PDO::PARAM_STR);
            $query->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->rowCount();
            $query->CloseCursor();

            if(empty($data)){
                echo "<script>alert('Un problème est survenu, recommencez..')</script>";
                echo "<script>window.location.replace('../mouvement.php');</script>";
            }else{
                echo "<script>alert('Sortie avec success..')</script>";
                echo "<script>window.location.replace('../mouvement.php');</script>";
            }
        }else{
            echo "<script>alert('La quantité de sortie est supérieure à la Quantité en stock..')</script>";
            echo "<script>window.location.replace('../mouvement.php');</script>";
        }

    }else{
        $query=$db->prepare("UPDATE produit SET qte= :qte WHERE code= :code");
        $query->bindValue(':qte', $data['qte'] + $qte_mvt, PDO::PARAM_INT);
        $query->bindValue(':code', $produit, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();

        $query=$db->prepare("INSERT INTO mouvement(qte_mvt, date, nature, code, username) VALUES (:qte, :date, :nature, :produit, :username)");
        $query->bindValue(':qte', $qte_mvt, PDO::PARAM_INT);
        $query->bindValue(':date', $date, PDO::PARAM_STR);
        $query->bindValue(':nature', $type, PDO::PARAM_STR);
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
        $query->execute();
        $data = $query->rowCount();
        $query->CloseCursor();

        if(empty($data)){
            echo "<script>alert('Un problème est survenu, recommencez..')</script>";
            echo "<script>window.location.replace('../mouvement.php');</script>";
        }else{
            echo "<script>alert('Ajouté avec success..')</script>";
            echo "<script>window.location.replace('../mouvement.php');</script>";
        }
    }
}else{
    echo "<script>alert('Veuillez remplir tous les champs..')</script>";
    echo "<script>window.location.replace('../mouvement.php');</script>";
}
