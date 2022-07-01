<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Kalus Hortensia</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
  <div class="bgimg">
    <div class="topleft">
      <img src="assets/img/5AH59I.png" style="width: 30%; margin-top: 25px;">
    </div>
    <div class="middle">
      <h1>Connectez-vous</h1>
      <hr>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
    </div>
    <div class="bottomleft">
      <p>Application de gestion de stockage dans un magasin</p>
    </div>
  </div>

  <div id="id01" class="modal">
    <form class="modal-content animate" action="functions/login.php" method="POST">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close"
          title="Close Modal">&times;</span>
        <img src="assets/img/img_avatar2.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Nom d'utilisateur" name="username" required>

        <label for="password"><b>Mot de passe</b></label>
        <input type="password" placeholder="Mot de passe" name="password" required>

        <button type="submit" name="submit">Connexion</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Se souvenir de moi
        </label>
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'"
          class="cancelbtn">Sortir</button>
        <span class="psw">Mot de passe oublié ? <a href="#">Cliquez ici.</a></span>
      </div>
    </form>
  </div>

  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>