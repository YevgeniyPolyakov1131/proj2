<?php

$this->titre = "Accueil";

?>

<div id='containt' class="row mt-5 mb-3 justify-content-center">


</div>

  <div class="container">

    <div class="row">

      <div class="col-lg-12">

      <!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

<!--Controls-->
<div class="controls-top">
  <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
  <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fas fa-chevron-right"></i></a>
</div>
<!--/.Controls-->

<!--Indicators-->
<!-- <ol class="carousel-indicators">
  <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
  <li data-target="#multi-item-example" data-slide-to="1"></li>
  <li data-target="#multi-item-example" data-slide-to="2"></li>
</ol> -->
<!--/.Indicators-->

<!--Slides-->
<div class="carousel-inner" role="listbox">
<h3>Liste des catégories</h3>
  <!--First slide-->
  <div class="carousel-item active">

    <div class="col-md-2 carousel-content" href="#">
     <a href="<?=$this->url('annonces/souscat/1')?>"> 
        <div class="card mb-2">
            <img class="card-img-top"
            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
            alt="Card image cap">
            <div class="card-body">
            <h4 class="card-title">Ordinateurs</h4>
            </div>
        </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content">
    <a href="<?=$this->url('annonces/souscat/5')?>">  
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Voitures</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content">
    <a href="<?=$this->url('annonces/souscat/17')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(35).jpg"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Appartements</h4>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-2 carousel-content">
    <a href="<?=$this->url('annonces/souscat/18')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Maisons</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/4')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Céllulaires</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/15')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(35).jpg"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Jouets</h4>
        </div>
      </div>
      </a>
    </div>

  </div>
  <!--/.First slide-->

  <!--Second slide-->
  <div class="carousel-item">

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/11')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title"> Homme</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/12')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title"> Femme</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/13')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title"> Enfants</h4>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/souscat/14')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Jeux</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/cat/3')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Animaux</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-2 carousel-content"> 
    <a href="<?=$this->url('annonces/cat/7')?>"> 
      <div class="card mb-2">
        <img class="card-img-top"
          src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">À Donner</h4>
        </div>
      </div>
      </a>
    </div>

  </div>

</div>

</div>

<div class="accueil_content">

<?php (isset($_GET['page'])) ? $page = ($_GET['page'] - 1): $page = 0; ?>
<h3>Liste des Annonces</h3>
 <div class="row accueil">


    <?php foreach ($annonces->page($page) as $annonce) : ?>
          <div class="col-lg-3  col-md-6 mb-4">
            <div class="card h-100">
                <div class='img_parent w-100'>
                    <a href="<?=$this->url('annonces/'.$annonce->annonce_id)?>">
                        <img class='annonce_img' src='<?= $annonce->image_url ?>'>
                     </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="<?=$this->url('annonces/'.$annonce->annonce_id)?>"><?= $annonce->annonce_titre ?></a>
                    </h4>
                    <h4 class="card-price "><?php $prix = ($annonce->annonce_prix > 0) ? $annonce->annonce_prix."$" : "Gratuit"; ?><?= $prix; ?></h4>
                    <p class="card-text"><?= $annonce->annonce_description ?></p>
                    <div class='location_date d-flex justify-content-between'>
                            <p class='ville'><?= $annonce->usager_date ?></p>
                            <p class='date'> <?= $annonce->ville ?></p>
                    </div>
                </div>
                
                
                
                <?php if($this->usagerConnecte()):?>
                    <div class="card-footer">
                                <?php if($_SESSION['usager_id'] == $annonce->usager_id || $_SESSION['usager_id'] == -1 ):?>

                                    <div class="annonceIcone ">
                                        <a class='suprimerAnnonce trigger-btn' id="<?= $annonce->annonce_id?>" href="#ModalDelete" data-toggle="modal" ><i class="far fa-trash-alt"></i></a> 
                                        <a class='modifierAnnonce' href="<?=$this->url('modifierAnnonce/'.$annonce->annonce_id)?>"><i class="far fa-edit"></i></a> 
                                        <a class='ajoutFavoris' id ="<?= $annonce->annonce_id?>"><i class="far fa-heart "></i></a> 
                                    </div>

                                <?php else:?>

                                    <div class="annonceIconeSeul ">
                                        <a class='ajoutFavoris' id ="<?= $annonce->annonce_id?>"><i class="far fa-heart "></i></a> 
                                    </div>
                                
                                <?php endif?> 
                    </div>
                <?php endif?>  
            </div>
          </div>

          <?php endforeach ?>

        </div>

        <?= $annonces->links() ?>
        </div>

      </div>
    </div>
    
  </div>


</body>

</html>
