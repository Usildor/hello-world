<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ajout Services</title>
</head>

<body>
	<h1 id="title">Veuillez renseigner vos informations pour completer l'inscription</h1>
    <h4 id="titlebis">Chez Error404, nous prenons à coeur la sécurité de vos données, et les données que vous entrez ne peuvent être utilisées que par nous, afin de garantir une meilleure utilisation de nos services.</h4>
   	<article id="remplissage">
    
    <form method="post" action="">

    <div>

        <h4>Contact</h4> 

        <label>Nom

        <input type="nom" id="nom" name="nom" value="<?php echo((empty($_POST['nom'])) ? "" : $_POST['nom']); ?>" required="required"/>
        </label></br>

       

        <label for="email">Email ou courriel: <span class="required">*</span>

        </label>

        <input type="email" id="email" name="email" value="<?php echo((empty($_POST['email'])) ? "" : $_POST['email']); ?>" placeholder="example@email.fr" required="required" />
        
        <label for="telephone">Numéro de téléphone: <span class="required">*</span>

        </label>

        <input type="phone" id="telephone" name="telephone" value="<?php echo((empty($_POST['telephone'])) ? "" : $_POST['telephone']); ?>" required="required" />
        
        <label for="telephone">Lien site web: <span class="required">*</span>

        </label>

        <input type="" id="lien_site" name="lien_site" value="<?php echo((empty($_POST['lien_site'])) ? "" : $_POST['lien_site']); ?>" required="required" />

    </div>


    <div>

        <h4>Adresse</h4> 

        <label for="message">Votre adresse:

        </label>

        <textarea id="adresse" name="adresse" value="<?php echo((empty($_POST['adresse'])) ? "" : $_POST['adresse']); ?>" placeholder="Entrez votre adresse ici"></textarea>
        <label>Code Postal:
        <input type="number" id="codePostal" name="codePostal" value="<?php echo((empty($_POST['codePostal'])) ? "" : $_POST['coddePostal']); ?>" required="required" />
        </label>

    </div>




    <div>

        <h4>Catégorie</h4>

        <label for="message">Catégorie :

        </label>

        <textarea id="categorie" name="categorie" value="<?php echo((empty($_POST['categorie'])) ? "" : $_POST['categorie']); ?>" placeholder="Entrez votre categorie ici"></textarea>

    </div>
    <div>
    <h4>Description</h4>

    <Label>Selectionnez la langue de votre description
        <select id="langue" name="langue">
            <option>Francais</option>
            <option>Anglais</option>
            <option>Arabe</option>
            <option>Klingon</option>
        </select>
      </Label></br>

    

        

        
        <label> Description
        <textarea id="texte" name="texte" value="<?php echo((empty($_POST['categorie'])) ? "" : $_POST['categorie']); ?>" placeholder="Decrivez ici votre service"></textarea></label>



    <div>

        <input type="submit" value="Suivant" id="submit" />

    </div>

</form>

    
    </article>
    
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, multilanguagePage: true}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
