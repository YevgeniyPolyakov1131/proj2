<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $titre ?></title>
  <link rel="stylesheet" href="<?= $this->url('vues/css/style.css') ?>">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="<?= $this->url('vues/js/index.js') ?>"></script>
  <link href="https://fonts.googleapis.com/css?family=Sarpanch:700,800,900|Rajdhani:600,700&display=swap" rel="stylesheet">




</head>

<body>

  <div id="container">

    <?php
    $sous_categories = Sous_categories::getAllSousCategoriesJoined(); 
    $categories = Categories::getAllCategories();
    // $favoris   = Favoris::getAllFavoris('favoris',1);
    ?>

    <header>

    <nav id='nav-mobile'>
         <h4 >
            <button class="btn btn-link collapsed font-weight-bold pl-0" type="button" data-toggle="collapse" data-target="#menu-mobile" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-bars"></i>  Menu
            </button>                      
        </h4>

         <div id="menu-mobile" class="menu-mobile accordion collapse" id="accordionExample " aria-labelledby="headingOne">
              <?php foreach ($categories as $categorie) : ?>
                  <div class="card w-100">
                      <div class="card-header h-10" id="headingOne">
                          <h2 class="mb-0" id="categorie_<?= $categorie->categorie_id; ?>">
                              <button class="btn btn-link collapsed font-weight-bold w-100 pl-0" type="button" data-toggle="collapse"  data-target="#collapse_<?= $categorie->categorie_id ?>" aria-expanded="true" aria-controls="collapseOne">
                              <i class="fas fa-sort-down"></i>  <?= $categorie->categorie_description ?> 
                              </button>
                          </h2>
                      </div>
                      <?php foreach ($sous_categories as $sous_categorie) : ?>
                          <?php if ($sous_categorie->categorie_id == $categorie->categorie_id) : ?>
                              <!-- Ceci sers a marquer les les categories qui ont des sous-categories -->
                              <script>var id = "categorie_"+<?= $categorie->categorie_id; ?>;</script>
                              <div id="collapse_<?= $sous_categorie->categorie_id ?>" class="collapse " aria-labelledby="headingOne" >
                                  <div class="card-body">
                                      <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                  </div>
                              </div>
                          <?php endif ?>
                      <?php endforeach ?>
                      <!-- Ceci sers a transformer les categories sans sous-categories en liens (e.g: a donner) -->
                      <script>
                          var nouvelId = "categorie_"+<?= $categorie->categorie_id; ?>;
                          if(nouvelId != id) {
                              var texte = $("#"+nouvelId+":first-child").text();
                              var html = '<a href="<?= $this->url('annonces/cat/'.$categorie->categorie_id) ?>"';
                              html    += 'class="btn btn-link">'+texte+'</a>';
                              $("#"+nouvelId+":first-child").html(html);
                          }
                      </script>
                  </div>
              <?php endforeach ?>
          </div>
      </nav>
      <div id='header'>


        <div id='logo'>
          <a href='<?= $this->url('') ?>'><img src="<?= $this->url('images/logo.png') ?>"></a>
        </div>


          
          <?php if($this->usagerConnecte()):?>
            
            <!-- recuperation de id user -->
            <p id="usager_id" style='display:none'><?= $_SESSION['usager_id'] ?></p>
            <div id='connected-account'>
                <a data-toggle="modal" data-target="#ModalFavoris" id='favoris'><i class="far fa-heart "></i><span id='idCount'></span></a>
                <a data-toggle="modal" data-target="#ModalCompte"  id='compte'><i class="far fa-user-circle"></i></a> 
            </div>
            <?php else:?>
              <div id='noneConnected-account'>
                <a id='inscription' href="<?= $this->url('inscription') ?>">Inscription</a>
                <a id='connection'  href="<?= $this->url('connexion') ?>">connection</a>
              </div>   
            <?php endif?>
        

            

        <div id='recherche'>
          <form name='frm' method='GET' class="for">

            <input name="motCle" type='text' placeholder='rechercher' class="form-control recherche">
            <input name="envoie" type='submit' value='chercher' class="btn btn-success">

          </form>
        </div>

      </div>

      <nav id='nav-desktop'>
        <ul class="row  justify-content-center ">
          <?php foreach ($categories as $categorie) : ?>
            <li class="dropbutton">
              <a href="<?= $this->url('annonces/cat/' . $categorie->categorie_id) ?>" class="btn btn-secondary">
                <?= $categorie->categorie_description ?>
              </a>
              <ul class="dropmenu">
                <?php foreach ($sous_categories as $sous_categorie) : ?>
                  <?php if ($sous_categorie->categorie_id == $categorie->categorie_id) : ?>

                    <li> <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a></li>

                  <?php endif; ?>
                <?php endforeach ?>
              </ul>
            </li>
          <?php endforeach ?>

        </ul>
      </nav>



 <!-------------------------------------------------- MODAL  Favoris--------------------------------------------------->

<div class="modal fade" id="ModalFavoris" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h2 id='favorisTitre'>Liste des Favoris</h2>
        <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
            

        


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn w-100 btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <!---------------------------------------------------------------------------------------------------------------------------->

 <!-------------------------------------------------- MODAL compte --------------------------------------------------->

<div class="modal fade" id="ModalCompte" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:750px">
    <div class="modal-content">
      <div class="modal-body">
      <h2 id='compteTitre'>Mon compte : &lpar; <?= $_SESSION['usager_id'] ?> &rpar;</h2>
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            
              <a href="<?= $this->url('profil') ?>">            <h3 id='Profil'>Mon profil</h3></a>
              <a href="<?= $this->url('compte/annonces') ?>">   <h3 id='mesAnnonces'>Mes annonces</h3></a>
              <a href="<?= $this->url('ajouterAnnonce')?>">     <h3 id='ajouterAnnonce'>Ajouter une annonce</h3></a>
              <a href="<?= $this->url('deconnexion') ?>">       <h3 id='deconnection'>Déconnecter</h3></a>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn w-100 btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




 <!----------------------------------------------------  MODAL delete  -------------------------------------------------------->


 <!-- Modal HTML -->
<div id="ModalDelete" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
				</div>				
				<h4 class="modal-title">Êtes-vous sûr?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Voulez-vous vraiment supprimer cet Annonce ? Ce processus ne peut pas être annulé</p>
			</div>
			<div class="modal-footer">
        <button type="button"  class="btn btn-info" data-dismiss="modal" >Cancel</button>
        <form action="" name="frm" method='GET'>
           <button type="submit" id="deletebouton" name='supprimer' class="btn btn-danger">Delete</button>
        </form>
			</div>
		</div>
	</div>
</div>  

<!-------------------------------- TEMPLATE -------------------------------->


<template id='t_annonce'>
    <div class="favoris row d-flex flex-row ">
            <div class='img_parent col-sm-3'>
                <a href="http://localhost/project_web2/annonces/${c.annonce_id}">
                    <img class='annonce_img' src='${c.image_url}'>
                  </a>
            </div>
            <div class='annonce-content  col-sm-9'>
                <a href="http://localhost/project_web2/annonces/${c.annonce_id}">
                    <div class='d-flex flex-row justify-content-between '>
                        <h4 class='titre'>${c.annonce_titre}</h4>
                        <h4 class='prix' >${c.annonce_prix}$</h4>

                            <?php $url = $_SERVER['REQUEST_URI']; ?>
                        <a class='suprimerFavoris' id="${c.annonce_id}"><i class="fas fa-heart "></i></a> 
                    </div>

                    <div class='location_date d-flex justify-content-between'>
                        <p class='ville'>${c.usager_date}</p>
                        <p class='date'> ${c.ville}</p>
                    </div>
                    <p class='description'>${c.annonce_description}</p>
                </a>
            </div>
      </div>
</template>



 <!------------------------------------------------------------------------->

 

    </header>




    <?= $contenu ?>




  </div>


  <!-- Footer -->
  <footer class="page-footer font-small indigo">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">

          <!-- Links -->
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Information</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!">À propos de nous</a>
            </li>
            <li>
              <a href="#!">termes et conditions</a>
            </li>
          </ul>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">

          <!-- Links -->
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Client de service</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!">Nous contacter</a>
            </li>
            <li>
              <a href="#!">Plan du site</a>
            </li>
          </ul>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">

          <!-- Links -->
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Extras</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!">Affiliations</a>
            </li>
            <li>
              <a href="#!">instructions</a>
            </li>
          </ul>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">

          <!-- Links -->
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Mon compte</h5>

          <ul class="list-unstyled">
            <li>
              <a href="<?= $this->url('profil') ?>">Mon compte</a>
            </li>
            <li>
              <a href="<?= $this->url('compte/annonces') ?>">mes annonces</a>
            </li>
          </ul>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class='reseau w-50 text-center d-flex justify-content-around'>
      <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
      <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
      <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="#" target="_blank"><i class="fab fa-google-plus-g"></i></a>
    </div>

    <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="#"> Yebemejo.com</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- <script>
 
  </script> -->
</body>

</html>