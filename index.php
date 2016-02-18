<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylesheet.css" >
    <title>Challenge Ajax</title>
  </head>
  <body>
    <?php
    // Afficher les erreurs à l'écran
    ini_set('display_errors', 1);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
    ?>
    <header>
      <h1>Challenge 6 : Ajax</h1>
      <br>
    </header>
    <section class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
          <!-- liste déroulante -->
          <form action="" method="post">
            <!--<select name="cliSelect" onchange="request(this.value)">-->
            <select name="cliSelect" onchange="request2(this.value)">
              <option value="">Sélectionner un client</option>
              <?php
              try
              {
                $bdd = new PDO('mysql:host=localhost;dbname=dmdbtest;charset=utf8', 'adminsql', 'mdpsql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
              }
              catch(Exception $e)
              {
                die('Erreur : '.$e->getMessage());
              }

              $req = $bdd->query("SELECT id, nom, prenom FROM client ORDER BY nom");

              while ($donnees = $req->fetch())
              {
                echo '<option value=' . $donnees['id'] . '>';
                echo htmlspecialchars($donnees['nom']) . ' ' . htmlspecialchars($donnees['prenom']);
                echo '</option>';
              }
              $req->closeCursor();
              ?>
            </select>
          </form>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
          <span id="contenu"></span>
        </div>
      </div>
    </section>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script>
    // Ajax Javascript :
    function request(idcli) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Solution 1 :
          document.getElementById('contenu').innerHTML = xhr.responseText;
          // Solution 2 :
          //var chaine = xhr.responseText;
          //var reg = new RegExp("[;]+", "g");
          //var tableau = chaine.split(reg);
          //var res = "";
          //for (var i=0; i<tableau.length; i++) {
          // res = res + tableau[i] + "<br>";
          //}
          //document.getElementById('contenu').innerHTML = res;
        } else {
          //alert("readyState = " + xhr.readyState + " ; status = " + xhr.status);
          document.getElementById('contenu').innerHTML = "!!! Problème !!!<br>readyState = " + xhr.readyState + " ; status = " + xhr.status;
        }
      };
      var params = "id=" + idcli;
      //alert('params : ' + params);
      xhr.open('POST','traitement.php',true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
      xhr.send(params);
    };
    // Ajax jquery : 
    function request2(idcli) {
      $.ajax({
        type: 'POST',
        data: "id=" + idcli,
        dataType: 'html',
        url: 'traitement.php',
        timeout: 3000,
        success: function(code_html, statut) {
          document.getElementById('contenu').innerHTML = code_html; },
        error: function(resultat, statut, erreur) {
          //alert('La requête n\'a pas abouti');
          document.getElementById('contenu').innerHTML = "!!! Problème !!!<br>erreur : " + erreur; }
      });
    };
    </script>
  </body>
</html>
