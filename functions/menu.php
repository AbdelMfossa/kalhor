    <div style="text-align: center;">
        <a href="home.php"><img src="assets/img/5AH59I.png" style="width: 10%; margin-top: 25px;"></a>
    </div>
    <p style="text-align:center;">Welcome <?= $_SESSION['username'] ?></p>
    
    <div class="topnav" id="myTopnav">
        <a href="home.php" <?php if ($page=='home') {echo 'class="active"';} ?> >Accueil</a>
        <a href="ajout_produit.php" <?php if ($page=='ajout') {echo 'class="active"';} ?> >Ajout produit</a>
        <a href="mouvement.php" <?php if ($page=='mouvement') {echo 'class="active"';} ?> >Mouvement</a>
        <a href="recherche.php" <?php if ($page=='recherche') {echo 'class="active"';} ?> >Recherche</a>
        <a href="alerte.php" style="color: red;">Stock Alerte</a>
        <div class="login-container">
            <form action="deconnexion.php">
                <button type="submit">Deconexion</button>
            </form>
        </div>
    </div>