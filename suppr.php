<?php
    session_start();
    include('functions/connexion.php');

    // Si l'utilisateur n'est pas connecté, renvoyer vers la page de connexion
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Veuillez vous connecter avant..')</script>";
        // header('Location: index.php');
        echo "<script>window.location.replace('index.php');</script>";
    }

    if ( (!empty($_GET["code"])) && (!empty($_GET["lib"])) ){
        $code = $_GET['code'];
        $libelle = $_GET['lib'];
    }else{
        echo "<script>alert('Produit non selectionné..')</script>";
        echo "<script>window.location.replace('home.php');</script>";
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suppression du produit <?= $libelle ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <style>
        #sup {
            text-align: center;
            padding-top: 25px;
        }
        #sup .btn {
            background-color: #aa0415;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php 
        $page = "modifier";
        include("functions/menu.php");
    ?>

    <div>
        <h2 style="text-align: center;">Voulez-vous vraiment supprimer le produit <?php echo $libelle. " / ". $code; ?> ?</h2>
        <div id="sup">
            <a href="functions/supprimer.php?code=<?= $code; ?>" class="btn">Supprimer</button>
        </div>
    </div>
</body>

</html>