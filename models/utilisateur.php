<?php

	function ajouterCle($bdd, $idu, $cle){
		$req = $bdd->prepare("UPDATE utilisateurs SET cle = :cle WHERE idUtilisateur = :idu ");
		$req->bindParam(':idu', $idu);
		$req->bindParam(':cle', $cle);
        $req->execute();
	}
	
	function ajouterUtilisateur($email, $pseudo, $mdp, $prenom, $nom, $telephone, $sexe, $dateNaissance, $codePostal, $adresse, $geolocalisation, $droits){
	    global $bdd;
		$req = $bdd->prepare("insert into utilisateurs(email, pseudo, mdp, avatar, prenom, nom, telephone, sexe, dateNaissance, codePostal, adresse, geolocalisation, droits) values(:email, :pseudo, :mdp, 'image.png',:prenom, :nom, :telephone, :sexe, :dateNaissance, :codePostal, :adresse, true, :droits)");
		$req->bindParam('email', $email);
		$req->bindParam('pseudo', $pseudo);
		$req->bindParam('mdp', $mdp);
		$req->bindParam('prenom', $prenom);
		$req->bindParam('nom', $nom);
		$req->bindParam('telephone', $telephone);
		$req->bindParam('sexe', $sexe);
		$req->bindParam('dateNaissance', $dateNaissance);
		$req->bindParam('codePostal', $codePostal);
		$req->bindParam('adresse', $adresse);
		$req->bindParam('droits', $droits);
		$req->execute();
		return $bdd->lastInsertId();
	}

	function connexionUtilisateur($email){
	    global $bdd;
	    $req = $bdd->prepare("SELECT idUtilisateur,mdp,verification,droits FROM utilisateurs WHERE email=:email");
	    $req->execute(array('email' => $email));
	    $data = $req->fetch();
	    if ($data == false)
	        return false;
	    else{
	        return $data;
        }
    }

    function mdpUtilisateur($idUtilisateur){
        global $bdd;
        $req = $bdd->prepare("SELECT mdp FROM utilisateurs WHERE idUtilisateur=:idUtilisateur");
        $req->execute(array('idUtilisateur' => $idUtilisateur));
        $data = $req->fetch();
        if ($data == false)
            return false;
        else{
            return $data['mdp'];
        }
    }
	
    function recupCle($bdd, $idu){
        $req = $bdd->prepare("SELECT cle FROM utilisateurs WHERE idUtilisateur = :idu ");
        if($req->execute(array('idu' => $idu)) && $row = $req->fetch()){
            $clebdd = $row['cle'];	// Récupération de la clé
            return $clebdd;
        }
        return false;
    }
	
	
	function active($bdd, $idu){
        $req = $bdd->prepare("UPDATE utilisateurs SET verification = 1 WHERE idUtilisateur = :idu ");
        $req->bindParam(':idu', $idu);
        $req->execute();
	}

    function desactive($idUtilisateur){
	    global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET verification = 0 WHERE idUtilisateur = :idUtilisateur ");
        $req->bindParam('idUtilisateur', $idUtilisateur);
        $req->execute();
    }
	
	
	function verifMail($bdd, $email){
		$req = $bdd->prepare("SELECT idUtilisateur FROM utilisateurs WHERE email=:email");
		$req->execute(array('email' => $email));
		$donnee = $req->fetch();
        if(!empty($donnee['idUtilisateur'])){
            return true;
        }
        else{
            return false;
        }
    }

    function infoUtilisateur($idUtilisateur){
	    global $bdd;
	    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = :idUtilisateur");
	    $req->bindParam('idUtilisateur', $idUtilisateur);
	    $req->execute();
	    $data = $req->fetch();
	    return $data;
    }

    function geolocaliserUtilisateur($idUtilisateur){
        global $bdd;
        $req = $bdd->prepare("SELECT geolocalisation FROM utilisateurs WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam('idUtilisateur', $idUtilisateur);
        $req->execute();
        $data = $req->fetch();
        if ($data == false or $data['geolocalisation'] == false){
            return false;
        }
        else{
            return true;
        }
    }

    function modifierInfoUtilisateur($idUtilisateur, $prenom, $nom, $pseudo, $codePostal, $adresse, $dateNaissance, $geolocalisation){
        global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET prenom=:prenom,nom=:nom,pseudo=:pseudo,codePostal=:codePostal,adresse=:adresse,dateNaissance=:dateNaissance,geolocalisation=:geolocalisation WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam('prenom', $prenom);
        $req->bindParam('nom', $nom);
        $req->bindParam('pseudo', $pseudo);
        $req->bindParam('codePostal', $codePostal);
        $req->bindParam('adresse', $adresse);
        $req->bindParam('dateNaissance', $dateNaissance);
        $req->bindParam('idUtilisateur', $idUtilisateur);
        $req->bindParam('geolocalisation', $geolocalisation);
        $result = $req->execute();
        return $result;
    }

    function changerMail($idUtilisateur, $email){
        global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET email=:email WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam('email', $email);
        $req->bindParam('idUtilisateur', $idUtilisateur);
        $result = $req->execute();
        return $result;
    }

    function changerMdp($idUtilisateur, $mdp){
        global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET mdp=:mdp WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam('mdp', $mdp);
        $req->bindParam('idUtilisateur', $idUtilisateur);
        $result = $req->execute();
        return $result;
    }

    function modifierAvatar($idUtilisateur, $avatar){
        global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET avatar=:avatar WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam("avatar", $avatar);
        $req->bindParam("idUtilisateur", $idUtilisateur);
        $req->execute();
    }

	function modifierDroits($idUtilisateur, $droits){
		
		global $bdd;
        $req = $bdd->prepare("UPDATE utilisateurs SET droits=:droits WHERE idUtilisateur=:idUtilisateur");
        $req->bindParam("droits", $droits);
        $req->bindParam("idUtilisateur", $idUtilisateur);
        $req->execute();
	}

	function verifMailAdmin($bdd, $email){
		
		global $bdd;
        $req = $bdd->prepare("SELECT email FROM emailsAdmin WHERE email=:email");
        $req->bindParam("email", $email);
        $req->execute();
	    $data = $req->fetch();
	    if ($data == false){
			
			return false;
		}
	        
	    else{
			
	        return true;
		}
	}


	function recupCleAdmin($bdd, $email){
		
		global $bdd;
        $req = $bdd->prepare("SELECT cle FROM emailsAdmin WHERE email=:email");
        $req->bindParam("email", $email);
        $req->execute();
	    $data = $req->fetch();
	    return $data['cle'];
		
	}

	function activeAdmin($bdd, $email){
        $req = $bdd->prepare("UPDATE utilisateurs SET droits = 'admin' WHERE email = :email ");
        $req->bindParam('email', $email);
        $req->execute();
	}

	function ajouterEmailsAdmin($bdd, $email, $hash){
		
		$cle=$hash;
		
		$req = $bdd->prepare("INSERT INTO emailsAdmin(cle, email) values(:cle, :email)");
        $req->bindParam('email', $email);
		$req->bindParam('cle', $cle);
        $req->execute();
		
	}

	function enleverEmailsAdmin($bdd, $email){
		
		$req = $bdd->prepare("DELETE FROM emailsAdmin WHERE email = :email");
        $req->bindParam('email', $email);

        $req->execute();
		
		
	}

	function recupMail($bdd, $idUtilisateur){
		
		$req = $bdd->prepare("SELECT email FROM utilisateurs WHERE idUtilisateur = :idUtilisateur ");
        $req->execute(array(':idUtilisateur'=> $idUtilisateur));
		$donnee = $req->fetch();
        return $donnee['email'];
			
	}

	function recupDroits($bdd, $idUtilisateur){
		
		$req = $bdd->prepare("SELECT droits FROM utilisateurs WHERE idUtilisateur = :idUtilisateur ");
        $req->execute(array(':idUtilisateur'=> $idUtilisateur));
		$donnee = $req->fetch();
        return $donnee['droits'];
		
	}

	function activeContributeur($bdd, $idUtilisateur){
		
		$req = $bdd->prepare("UPDATE utilisateurs SET droits = 'contributeur' WHERE idUtilisateur = :idUtilisateur ");
        $req->execute(array(':idUtilisateur'=> $idUtilisateur));
        $req->execute();
		
		
	}
	