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
    <title>Recherche | Kalus Hortensia</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <?php 
        $page = "recherche";
        include("functions/menu.php");
    ?>

    <div>
        <h2 style="text-align: center;">Recherche d'un produit</h2>
        <div class="div-form">
            <form action="" method="POST">
                <label for="produit">Produit</label>
                <?php
                    $query=$db->prepare("SELECT * FROM produit order by libelle ");
                    $query->execute();
                ?>
                <select id="produit" name="produit">
                    <option value="">---------</option>
                    <?php 
                        while ($row = $query->fetch()) {
                            if (!empty($_POST["produit"])){
                    ?>
                                <option value="<?= $row['code'] ?>" <?php if ($row['code']==$_POST['produit']){echo 'selected';} ?> ><?php echo $row['libelle']; ?></option>
                    <?php 
                            }else{
                    ?>
                               <option value="<?= $row['code'] ?>"><?php echo $row['libelle']; ?></option> 
                    <?php
                            }
                        }
                        $query->CloseCursor();
                    ?>
                </select>

                <input type="submit" value="Rechercher">
            </form>
        </div><br><br>

        <?php
            if (!empty($_POST["produit"])){
                $produit = $_POST["produit"];
                $query=$db->prepare("SELECT code, libelle, prix_unitaire, qte, (prix_unitaire*qte) AS montant FROM produit WHERE code= :code order by libelle");
                $query->bindValue(':code', $produit, PDO::PARAM_STR);
                $query->execute();
                $data = $query->fetch();
        ?>
                <table>
                    <tr>
                        <th>Code</th>
                        <th>Nom produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité en stock</th>
                        <th>Montant</th>
                        <th>Options</th>
                    </tr>
                    <tr>
                        <td><?php echo $data['code']; ?></td>
                        <td><?php echo $data['libelle']; ?></td>
                        <td><?php echo $data['prix_unitaire']; ?> FCFA</td>
                        <td><?php echo $data['qte']; ?></td>
                        <td><?php echo $data['montant']; ?></td>
                        <td><a href="modifier.php?code=<?= $data['code']; ?>">Modifier</a> | <a href="suppr.php?code=<?= $data['code']; ?>&lib=<?= $data['libelle']; ?>" style="color: red;">Supprimer</a></td>
                    </tr>
                </table>
        <?php
                $query->CloseCursor();
            }
        ?>
    </div>
</body>

</html>