<?php
	if(!empty($_POST['typeService']) or !empty($_POST['nomService']) or !empty($_POST['adresse']) or !empty($_POST['dejaValide'])){
		$typeService = $_POST['typeService'];
		$nomService = $_POST['nomService'];
		$adresse = $_POST['adresse'];
		if(!empty($_POST['page2'])){
			$page2 = $_POST['page2'];
		}
		else{
			$page2 = 1;
		}
		$retour = dataTypeService($page2,$typeService);
		$data = $retour[0];
		$nombreDePages = $retour[1];
		$pageActuelle = $retour[2];
		}
include("templates/accueil_admin.php");
?>
