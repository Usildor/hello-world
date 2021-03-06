
<head>
  <link rel="stylesheet" type="text/css" href="static/pageServiceAdmin/pageServiceAdmin.css"> <!-- Attention à bien remplacer le lien vers le fichier CSS -->
  <meta charset="utf-8" />
  <title>Test</title>
</head>

    <main>
      <div id="EnTete">
          <div id="h"> Médecin Sans Frontière <br> Page de Service </div>
      </div>

      <section id="Service">
        <div id="IconeCategorie"> <img src=<?php
          switch($contact["categorie"]){ /* Rajouter des Cases ici et des images dans Média/Pictogrammes/ pour couvrir plus de catégorie */
            case "logement":
              echo "Média/Pictogrammes/logement.png";
              break;
            case "connaissance":
              echo "Média/Pictogrammes/connaissance.png";
              break;
            case "soin":
              echo "Média/Pictogrammes/soin.png";
              break;
            case "nourriture":
              echo "Média/Pictogrammes/nourriture.png";
              break;
          }
        ?> width="50" height="50"> </div> <!-- Icone du service -->
        <div id="b1">
          <div id="t1"> <?php echo $contact["nom"] ?> </div> <!-- Nom du service !-->
          <article>
            <h1> Description du Service:</h1>
            <div id="Description">
              <div id="alinea">
                <?php echo $description["texte"] ?> </br>
                Note: <?php echo $noteService[0]?>
              </div>
            </div>
            <h1>Nous Joindre:</h1>
            <div id="Contact">
              Adresse: <?php echo $contact["adresse"] ?> </br> <?php echo $contact["codePostal"] ?>
              Numéro de téléphone: <?php echo $contact["telephone"] ?> </br>
              Mail: <?php echo $contact["email"]; ?> </br>
              <a id="Mail" href="<?php echo $contact["lien_site"]; ?>"> Notre Site </a>
            </div>
            <h1>Historique des services proposés:</h1>
            <form action="" method="post" id="formulaireCommentaire">

              <table>
                <thead>
                  <tr>
                    <td>Date</td>
                    <!-- <td>Type de Service</td> -->
                    <td>Nombre d inscrits</td>
                    <td>Capacité de l'évènement</td>
                    <td>Note de la séance</td>
                    <!--<td>Satisfaction</td> -->
                    <td>Inscription</td>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($index=0;$index<$longueur;$index ++){ ?>
                    <tr>
                      <td> <?php echo $seances[$index]["date"] ?> </td>
                      <!-- <td> <?php /* echo $seances[$index][2] */ ?> </td> -->
                      <td> <?php if(!empty($lesInscrits[$index+$seances[0][0]][0])){
                         echo $lesInscrits[$index+$seances[0][0]][0];
                       }?> </td>
                      <td><?php echo $seances[$index]["capacite"]?></td>
                      <td><?php if(!empty($notesSeances[$index])){
                        echo $notesSeances[$index];
                      }?></td>
                      <!-- <td> <?php echo $satisfaction[0][$index] ?> </td> -->
                      <td><?php
                      $check = false;
                      foreach ($estInscrit as $element){
                        if ($element["idSeance"]=$seances[$index]["idSeance"]){
                          $check = true;
                        }
                      }
                      if ($check){
                        echo ('<input type="checkbox" name="inscription[]" value="'.$seances[$index]["idSeance"].'" checked="checked"/>') ;
                      }
                      else{
                        echo ('<input type="checkbox" name="inscription[]" value="'.$seances[$index]["idSeance"].'"/>') ;
                      }/*echo($check ? "Inscrits" : "Non inscrits");*/
                      ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>

              <input type="submit" name="validerInscript" value="valider"/>
            </form>



            <h1>Commentaires</h1>
            <article id="Commentaires"> <!<!-- ATTENTION AU S DE Commentaire -->
              <form action="" method="post" id="censureCommentaire">


                <?php for ($index=0;$index<$longComment;$index ++){ ?>
                  <article id="Commentaire">

                    <aside id="Avatar">
                      <img src=<?php echo "Média/Avatars/".$profil[$index]["avatar"]?> width="75" height="75"> <?php /* echo <img src="???"+$commentaires[?] width="50" height="50"> */ ?>
                      </br> <div id="center"> <?php echo $profil[$index]["pseudo"] ?> </div> <!-- Pseudo de l'utilisateur !-->
                    </aside>

                    <div id="b2">
                      <article id="TexteComment">
                        <p>Commentaire:</p> <div id="alinea"> <?php echo $commentaires[$index]["texte"] ?> </div>
                      </article>

                      <div id="Note">
                        <p>Note:
                          <?php $note=$commentaires[$index]["note"];
                            $index2=1;
                            while ($index2<=$note){ ?>
                              <img src="static/pageServiceAdmin/etoileRouge.png" width="30" height="30">
                              <?php $index2++;
                            }
                          if ($note>=((int)$note+0.5)){ ?>
                            <img src="static/pageServiceAdmin/demiEtoileRouge.png" width="15" height="30">
                          <?php } ?>
                        </p>
                      </div>

                      <?php if($admin){
                        if ($commentaires[$index]["censure"]==0){
                          echo '<input type="submit" name="censureCommentaire'.$commentaires[$index]["idCommentaire"].'" value="Censurer"/>';
                        }
                        else{
                          echo '<input type="submit" name="rehabiliterCommentaire'.$commentaires[$index]["idCommentaire"].'" value="Réhabiliter"/>';
                        }
                      }?>

                    </div>
                  </article>
                <?php } ?>
              </form>



              <article id="Commentaire">
                <aside id="Avatar">
                  <img src=<?php echo "Média/Avatars/".$profilSession["avatar"]?> width="75" height="75">
                  </br> <div id="center"> <?php echo $profilSession["pseudo"] ?> </div>
                </aside>

                  <form action="" method="post" id="formulaireCommentaire">
                    <article id="TexteComment">
                      <p>
                        <label for="texte"> Commentaire </label>: </br> <textarea type="text" id="text" name="text" placeholder="Votre Commentaire"></textarea>
                      </p>
                    </article>
                    <div id="Note">
                      <p>
                        <label for="note"> Note sur 5 </label>: </br> <input type="number" id="note" name="note" min=0.0, max=5.0, step=0.5 placeholder="/5"/>
                      </p>
                    </div>
                    <div>
                      <input type="submit" name="valider" value="valider">
                    </div>
                  </form>

              </article>



            </article>
            <?php if($admin==1){ ?>
              <h1>Note du Contributeur:</h1>
              <article id="NoteContrib">
                <?php echo $contact["noteDeMAJ"] ?>
              </article>
            <?php } ?>
          </article>
          <?php if($admin==1){ ?>
            <form action="" method="post" id="formulaireValidationAdmin">
              <p>Autorisez vous ce service à apparaître dans la liste des services? </p>
              <input type="submit" value="Valider" name="validerAdmin" id="validationAdmin">
              <input type="submit" value="Bloquer" name="bloquerAdmin" id="validationAdmin">
            </form>
          <?php } ?>
        </div>
        <div id="vide">  </div>
      </section>

      <?php print_r($_POST); ?>

    </main>
