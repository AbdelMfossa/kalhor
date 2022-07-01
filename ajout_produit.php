<?php
    session_start();
    include('functions/connexion.php');

    // Si l'utilisateur n'est pas connecté, renvoyer vers la page de connexion
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Veuillez vous connecter avant..')</script>";
        // header('Location: index.php');
        echo "<script>window.location.replace('index.php');</script>";
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> -->
    <title>Ajout produit | Kalus Hortensia</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <?php 
        $page = "ajout";
        include("functions/menu.php");
    ?>

    <div>
        <h2 style="text-align: center;">Ajouter un nouveau produit</h2>
        <div class="div-form">
            <form action="functions/ajout.php" method="POST">
                <label for="code">Code produit</label>
                <input type="text" id="code" name="code" placeholder="Code du produit.." required>

                <label for="libelle">Libellé</label>
                <input type="text" id="libelle" name="libelle" placeholder="Libellé du produit.." required>

                <label for="pu">Prix unitaire (en FCFA)</label>
                <input type="number" id="pu" name="pu" placeholder="Prix unitaire.." required>

                <label for="qte">Qté départ</label>
                <input type="number" id="qte" name="qte" placeholder="Quantité de départ.." required>

                <input type="submit" value="Enregistrer">
            </form>
        </div>
    </div>
</body>

</html>