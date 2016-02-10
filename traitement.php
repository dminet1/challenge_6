<?php
  // Afficher les erreurs à l'écran
  ini_set('display_errors', 1);
  // Enregistrer les erreurs dans un fichier de log
  ini_set('log_errors', 1);
  // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
  ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
?>
<?php
if (isset($_POST['id']) AND $_POST['id'] !='') {
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=dmdbtest;charset=utf8', 'adminsql', 'mdpsql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  $query = $bdd->query("SELECT * FROM client WHERE id=".$_POST['id']);
  $back = $query->fetch();
    echo "<table style='margin:auto;border-collapse:collapse'>";
    echo "<tr><td style='border:1px solid black;padding:5px'colspan=2>Données du client sélectionné</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>nom</td><td style='border:1px solid black;padding:5px'>" . $back["nom"] . "</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>prénom</td><td style='border:1px solid black;padding:5px'>" . $back["prenom"] . "</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>profession</td><td style='border:1px solid black;padding:5px'>" . $back["profession"] . "</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>âge</td><td style='border:1px solid black;padding:5px'>" . $back["age"] . "</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>email</td><td style='border:1px solid black;padding:5px'>" . $back["email"] . "</td></tr>";
    echo "<tr><td style='border:1px solid black;padding:5px'>téléphone</td><td style='border:1px solid black;padding:5px'>" . $back["telephone"] . "</td></tr>";
    echo "</table>";
  $query->closeCursor();
}
?>
