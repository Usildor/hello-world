<?php
include("models/pageServiceAdmin.php");
$idService=1; /*$_GET['idService']; */
$seances=tableau($idService);
$satisfaction=satisfaction($idService,$seances);
$commentaires=commentaires($idService);
$description=description($idService);
$contact=contact($idService);
$longueur=count($seances);
$longComment=count($commentaires);
$lesInscrits=lesInscrits($idService);
include("templates/pageServiceAdmin.php");
 ?>
