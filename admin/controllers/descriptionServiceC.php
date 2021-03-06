<?php
include("../models/descriptionService.php");

if(empty($_GET['idService'])){
  header("Location: ".SOUS_DOMAINE_ROOT."?page=error404");
  exit();
}
else{
  $idService=$_GET['idService'];
}

$seances=seances($idService);
$noteService=noteService($idService);
$satisfaction=satisfaction($idService,$seances);
$commentaires=commentaires($idService);
$profil=profil($idService);
$description=description($idService);
$contact=contact($idService);
$longueur=count($seances);
$longComment=count($commentaires);
/*$notesSeances=notesSeances($idService);*/
$lesInscrits=lesInscrits($idService);

$admin=0;
if(!empty($_SESSION["idAdministrateur"])){
  $admin=1;
  $idUtilisateur=$_SESSION["idAdministrateur"];
  $login=1;
  $estInscrit=estInscrit($idService,$idUtilisateur);
  $isFavoris=isFavoris($idService,$idUtilisateur);
  $profilSession=profilSession($idUtilisateur);
}

if (!empty($_POST["valider"]) && $_POST["note"]<=5){
  $note=$_POST["note"];
  $texte=htmlspecialchars($_POST["text"]);
  ajoutCommentaire($note,$texte,$idUtilisateur,$idService);  /*$_POST["idSeance"]*/
  ajoutNote($idService,noteService($idService)["note"]);
  header("Location: ");
  exit();
}

if (!empty($_POST["validerInscript"])){
  foreach($seances as $seance){
    $check1=0;
    $check2=0;
    if(empty($_POST["inscription"])){
      modifInscription(false,$idService,$seance["idSeance"],$idUtilisateur);
    }
    else{
      if (in_array($seance["idSeance"],$_POST["inscription"])){
        $check2=1;
      }
      foreach($estInscrit as $inscription){
        if (in_array($seance["idSeance"],$inscription)){
          $check1=1;
        }
      }
      if($check1!=$check2){
        if($check2==0){
          modifInscription(false,$idService,$seance["idSeance"],$idUtilisateur);
        }
        else{
          modifInscription(true,$idService,$seance["idSeance"],$idUtilisateur);
        }
      }
    }
  }
  header("Location: ");
  exit();
}

if (!empty($_POST["validerAdmin"])){
  validationService($idService,1);
  header("Location: ");
  exit();
}
if (!empty($_POST["bloquerAdmin"])){
  validationService($idService,0);
  header("Location: ");
  exit();
}

for ($index=0;$index<$longComment;$index ++){
  $idCommentaire = $commentaires[$index]["idCommentaire"];
  if (!empty($_POST["censureCommentaire".$idCommentaire])){
    censureCommentaire($idCommentaire,1);
    header("Location: ");
    exit;
  }
  if (!empty($_POST["rehabiliterCommentaire".$idCommentaire])){
    censureCommentaire($idCommentaire,0);
    header("Location: ");
    exit;
  }
}


if(!empty($_POST["validerFavoris"])){
  modifFavoris($isFavoris,$idService,$idUtilisateur);
  header("Location: ");
  exit();
}

/*print_r($seances);*/

include("templates/descriptionService.php");
 ?>
