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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Stock d'alerte | Kalus Hortensia</title>
</head>

<body>
    <?php 
        $page = "alerte";
        include("functions/menu.php");
    ?>

    <div style="text-align: center;">
        <h2>Les produits en stock d'alerte</h2>
        <?php
            $query=$db->prepare("SELECT * FROM produit WHERE qte <= 5 order by qte");
            $query->execute();
        ?>
        <table>
            <tr>
                <th>Code</th>
                <th>Nom produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Options</th>
            </tr>
            <?php while ($row = $query->fetch()) { ?>
                <tr>
                    <td><?php echo $row['code']; ?></td>
                    <td><?php echo $row['libelle']; ?></td>
                    <td><?php echo $row['prix_unitaire']; ?> FCFA</td>
                    <td style="color: red;"><?php echo $row['qte']; ?></td>
                    <td><a href="mouvement.php" style="color: green;">Mouvement</a> |  <a href="suppr.php?code=<?= $row['code']; ?>&lib=<?= $row['libelle']; ?>" style="color: red;">Supprimer</a></td>
                </tr>
            <?php 
                } 
                $query->CloseCursor();
            ?>
        </table>
    </div>
</body>

</html>