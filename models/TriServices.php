<?php

if(!empty($_POST['catégorie']))&&(!empty($_POST['adresse'])){
		$typeService = $_POST['catégorie'];
		$adresse = $_POST['adresse']


		
	$req = $bdd->prepare("SELECT * FROM services WHERE categorie=$typeService AND adresse=$adresse AND validation --ORDER BY distance");
	$req->execute(array('idService'));
	$data=$req->fetchall();
	}
	else if(!empty($_POST['catégorie']))&&(empty($_POST['adresse'])){
		

		$req = $bdd->prepare("SELECT * FROM services WHERE categorie=$typeService AND validation=true--ORDER BY distance");
		$req->execute(array('idService'));
		$data=$req->fetchall();
	}
	else if(empty($_POST['catégorie']))&&(!empty($_POST['adresse'])){
		$adresse = $_POST['adresse']

		$req = $bdd->prepare("SELECT * FROM services WHERE adresse=$adresse AND validation=true--ORDER BY distance");
		$req->execute(array('idService'));
		$data=$req->fetchall();
	}
	else {
		$req = $bdd->prepare("SELECT * FROM services WHERE validation=true--ORDER BY distance");
		$req->execute(array('idService'));
		$data=$req->fetchall();
	}
?>