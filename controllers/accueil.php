<?php
include ("templates/accueil.php");
include ("models/TriServices.php");
/*include ("models/services.php");  déjà appelé dans l'index:""require_once("models/services.php")"";*/

if(!empty($_POST['catégorie'])&&(!empty($_POST['adresse']))){
	$data=obtenirServiceParLocalisationEtCategorie($categorie, $adresse);
}
else if(!empty($_POST['catégorie'])&&(empty($_POST['adresse']))){
	$data=obtenirServiceParCategorie($categorie);
}
else if(empty($_POST['catégorie'])&&(!empty($_POST['adresse']))){
	$data=obtenirServiceParLocalisation($adresse);
}
else {
	$data=obtenirSansEntree();
}
?>

