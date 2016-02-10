<?php
DEFINE(SERVER,"localhost");
DEFINE(LOGIN,"adminsql");
DEFINE(MDP,"mdpsql");
DEFINE(BASE,"dmdbtest");
$connect=mysqli_connect(SERVER,LOGIN,MDP,BASE) or die("pb de connexion au serveur");
// INSERT INTO client VALUES('id','nom','prenom','age','profession','email','telephone') :
mysqli_query($connect,"INSERT INTO client VALUES('','Durand','Bernard','22','Etudiant','bdurand@gmail.com','0611223344')");
mysqli_query($connect,"INSERT INTO client VALUES('','Dupont','Daniel','32','Informaticien','ddupont@gmail.com','0622334455')");
mysqli_query($connect,"INSERT INTO client VALUES('','Delpierre','Kevin','44','Boulanger','kdelpierre@gmail.com','0633445566')");
mysqli_query($connect,"INSERT INTO client VALUES('','Lefèvre','Bernadette','56','Médecin','blefevre@gmail.com','0644556677')");
mysqli_query($connect,"INSERT INTO client VALUES('','Marin','Danièle','67','Retraitée','dmarin@gmail.com','0655667788')");
$result=mysqli_query($connect,"SELECT * FROM client");
while($data=mysqli_fetch_assoc($result)){
  // utf8_encode() pour gérer l'affichage des caractères accentués :
  echo "nom : ".utf8_encode($data['nom'])."<br/>";
  echo "prenom : ".utf8_encode($data['prenom'])."<br/><br/>";
}
?>
