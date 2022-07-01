<?php
    session_start();
    include('functions/connexion.php');

    // Si l'utilisateur n'est pas connecté, renvoyer vers la page de connexion
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Veuillez vous connecter avant..')</script>";
        // header('Location: index.php');
        echo "<script>window.location.replace('index.php');</script>";
    }

    if (!empty($_GET["code"])){
        $code = $_GET['code'];
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
    <title>Modifier produit | Kalus Hortensia</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <?php 
        $page = "modifier";
        include("functions/menu.php");
    ?>

    <div>
        <h2 style="text-align: center;">Modification du produit <?php echo $code; ?> </h2>

    <?php
        $query=$db->prepare("SELECT * FROM produit WHERE code = :code");
        $query->bindValue(':code', $code, PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
    ?>

        <div class="div-form">
            <form action="functions/modif_produit.php" method="POST">

                <input type="hidden" value="<?= $code ?>" name="code">

                <label for="libelle">Libellé</label>
                <input type="text" id="libelle" value="<?= $data['libelle'] ?>" name="libelle" placeholder="Libellé du produit.." required>

                <label for="pu">Prix unitaire (en FCFA)</label>
                <input type="number" id="pu" value="<?php echo $data['prix_unitaire']; ?>" name="pu" placeholder="Prix unitaire.." required>

                <label for="qte">Quantité</label>
                <input type="number" id="qte" value="<?= $data['qte'] ?>" name="qte" placeholder="Quantité.." required>

                <input type="submit" value="Mettre à jour">
            </form>
        </div>
        <?php $query->CloseCursor(); ?>
    </div>
</body>

</html>