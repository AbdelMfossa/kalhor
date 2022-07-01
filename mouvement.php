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
    <title>Mouvement | Kalus Hortensia</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <?php 
        $page = "mouvement";
        include("functions/menu.php");
    ?>

    <div>
        <h2 style="text-align: center;">Mouvement sur un produit</h2>
        <div class="div-form">
            <form action="functions/mvt.php" method="POST">
                <label for="produit">Produit</label>
                <?php
                    $query=$db->prepare("SELECT * FROM produit order by libelle ");
                    $query->execute();
                ?>
                <select id="produit" name="produit">
                    <option value="">---------</option>
                    <?php while ($row = $query->fetch()) { ?>
                        <option value="<?= $row['code'] ?>"><?php echo $row['libelle']. "  (". $row['qte'] .")"; ?></option>
                    <?php 
                        } 
                        $query->CloseCursor();
                    ?>
                </select>

                <label for="qte">Quantité</label>
                <input type="number" id="qte" name="qte" placeholder="Quantité.." required>

                <label for="date">Date</label>
                <input type="date" id="date" name="date" placeholder="Date du mouvement.." required>

                <label>Nature</label><br>
                <input type="radio" id="type1" name="type" value="Entrée" required style="margin-top: 12px;"> <label for="type1">Entrée</label> 
                <input type="radio" id="type2" name="type" value="Sortie" required> <label for="type2">Sortie</label> 

                <input type="submit" value="Enregistrer">
            </form>
        </div>

        <h3 style="text-align: center;">Historique des Entrées-Sorties</h3>
        <?php
            $query=$db->prepare("SELECT * FROM mouvement m, produit p WHERE m.code=p.code order by id_mvt DESC");
            $query->execute();
        ?>
        <table>
            <tr>
                <th>Identifiant</th>
                <th>Produit / Code</th>
                <th>Quantité</th>
                <th>Nature</th>
                <th>Date</th>
                <th>Utilisateur</th>
            </tr>
            <?php while ($row = $query->fetch()) { ?>
                <tr>
                    <td><?= $row['id_mvt'] ?></td>
                    <td><?= $row['libelle'] ?> / <?= $row['code'] ?></td>
                    <td><?= $row['qte_mvt'] ?></td>
                    <td><?= $row['nature'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['username'] ?></td>
                </tr>
            <?php 
                } 
                $query->CloseCursor();
            ?>
        </table>
    </div>

    <script>
        document.getElementById('date').valueAsDate = new Date();
    </script>
</body>

</html>