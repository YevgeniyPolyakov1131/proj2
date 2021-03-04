<?php

$this->titre = "Annonces";


?>

<div id='containt' class="row mt-5 mb-5 justify-content-center ">

    <div id="filtre" class="col-sm-3">

        <h4>Filtrez</h4>
        <?php if (isset($id_cat)) : ?>
            <div class=" filtre_contents accordion" id="accordionExample">
            <h5 class='filtre_titles'>categories :</h5>
            <?php foreach ($categories as $categorie) : ?>
                <?php if ($categorie->categorie_id == $id_cat) : ?>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0" id="categorie_<?= $categorie->categorie_id; ?>">
                            <button class="btn btn-link collapsed font-weight-bold pl-0 w-100" type="button" data-toggle="collapse" data-target="#collapse_<?= $categorie->categorie_id ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $categorie->categorie_description ?> <i class="fas fa-sort-down"></i>
                            </button>
                        </h2>
                    </div>
                    <?php foreach ($sous_categories as $sous_categorie) : ?>
                        <?php if ($sous_categorie->categorie_id == $categorie->categorie_id) : ?>
                            <!-- Ceci sers a marquer les les categories qui ont des sous-categories -->
                            <script>var id_filtre = "categorie_"+<?= $categorie->categorie_id; ?>;</script>

                            <div id="collapse_<?= $sous_categorie->categorie_id ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <!-- Ceci sers a transformer les categories sans sous-categories en liens (e.g: a donner) -->
                    <script>
                          var nouvelId_filtre = "categorie_"+<?= $categorie->categorie_id; ?>;
                          if(nouvelId_filtre != id_filtre) {
                              var texte = $("#"+nouvelId_filtre+":first-child").text();
                              var html = '<a href="<?= $this->url('annonces/cat/'.$categorie->categorie_id) ?>"';
                              html    += 'class="btn btn-link">'+texte+'</a>';
                              $("#"+nouvelId_filtre+":first-child").html(html);
                          }
                      </script>

                </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
        <?php endif; ?>

        <?php if (isset($id_sous_cat)) : ?>
        <label for="sous-categorie"> categorie :</label>
        <div class="accordion" id="accordionExample">

            <?php foreach ($sous_categories as $sous_categorie) : ?>
                <?php if ($sous_categorie->sous_categorie_id == $id_sous_cat) : ?>
                <div class="card">
                    <div class="card-header pl-0" id="headingOne">
                        <p class="mb-0 ">
                                <a class="dropdown-item font-weight-bolder" href="<?= $this->url('annonces/cat/' . $sous_categorie->categorie_id) ?>"><?= $sous_categorie->categorie_description ?><i class="fas fa-sort-up"></i></a>
                         </p>
                    </div>
                        
                                <div class="card-body pl-4">
                                    <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                </div>
    
                </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
        <?php endif; ?>







        <div class='filtre_contents'>

            <form name="frm"  action="" method="GET">
                <h5 class='filtre_titles'>Prix</h5>
                    <div class="input-group mb-3">
                        <?php (isset($_GET['prixMin'])) ? $prix = $_GET['prixMin'] : $prix = '';  ?>
                        <input type="number" class="form-control form-control-sm" placeholder="min" name="prixMin" value="<?php echo $prix ?>">
                    </div>

                    <div class="input-group mb-3">
                        <?php (isset($_GET['prixMax'])) ? $prix = $_GET['prixMax'] : $prix = '';  ?>
                        <input type="number" class="form-control form-control-sm" placeholder="max" name="prixMax" value="<?php echo $prix ?>">
                    </div>
                    <input type="submit" name="prix" value="filtrez prix" class="btn btn-success btn-sm"> 

            </form>
        </div>

        <div class='filtre_contents'>
            <form name="frm" action="" method="GET">
                <h5 class='filtre_titles'>date d'apparition </h5>
                    <div class="input-group mb-3">
                         <?php (isset($_GET['dateMin'])) ? $dateMin = $_GET['dateMin'] : $dateMin = '';  ?>
                        <input type="date" class="form-control form-control-sm" placeholder="min" name="dateMin" value="<?php echo $dateMin ?>">
                    </div>

                    <div class="input-group mb-3">
                         <?php (isset($_GET['dateMax'])) ? $dateMax = $_GET['dateMax'] : $dateMax = '';  ?>
                        <input type="date" class="form-control form-control-sm" placeholder="max" name="dateMax" value="<?php echo $dateMax ?>">
                    </div>
                    <input type="submit" name="date" value='filtrez date' class="btn btn-success btn-sm">
            </form>
        </div>

        <div class='filtre_contents'>
            <form name="frm" action="" method="GET">
                <h5 class='filtre_titles'> Lieu</h5>
                
                    <label for="province">Province</label>
                    <select class="form-control form-control-sm" name="province" id="lieuProvince">

                        <?php foreach ($provinces as $province) : ?>
                            <?php if (isset($_GET['province'])) $province_id = $_GET['province'];
                                    else $province_id = 0 ?>
                                        <option value="<?= $province->province_id ?>" <?= ($province_id == $province->province_id) ? "selected" : "" ?>><?= $province->province ?></option>
                        <?php endforeach ?>
                    </select><br>

                    <label for="ville">Ville</label><br>
                    <select class="form-control form-control-sm" name="ville" id="lieuVille">
                        <?php foreach ($provinces as $province) : ?>
                            <?php foreach ($villes as $ville) : ?>
                                <?php if ($province->province_id == $ville->province_id) : ?>
                                    <?php if (isset($_GET['ville'])) $ville_id = $_GET['ville'];
                                    else $ville_id = 0 ?>
                                   
                                    <option value="<?= $ville->ville_id ?>" <?= ($ville_id == $ville->ville_id) ? "selected" : "" ?>><?= $ville->ville ?></option>
                                <?php endif; ?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    </select>

                    <br>
                    <input type="submit" name="lieu" value="filtrez lieu" class="btn btn-success btn-sm">

                </form>
            </div>


    </div>

    <div id="filtre-mobile" class="col-sm-12 accordion">
    <?php if (isset($id_cat)) : ?>
            <div class="categorie_liste filtre_contents accordion" id="accordionExample">
            <h5 class='filtre_titles'>categories :</h5>
            <?php foreach ($categories as $categorie) : ?>
                <?php if ($categorie->categorie_id == $id_cat) : ?>
                <div class="card">
                    <div class="card-header" id="headingOne2">
                        <h2 class="mb-0" id="categorie_<?= $categorie->categorie_id; ?>">
                            <button class="btn btn-link collapsed font-weight-bold pl-0 w-100" type="button" data-toggle="collapse" data-target="#collapse_<?= $categorie->categorie_id ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $categorie->categorie_description ?> <i class="fas fa-sort-down"></i>
                            </button>
                        </h2>
                    </div>
                    <?php foreach ($sous_categories as $sous_categorie) : ?>
                        <?php if ($sous_categorie->categorie_id == $categorie->categorie_id) : ?>
                            <!-- Ceci sers a marquer les les categories qui ont des sous-categories -->
                            <script>var id_filtre = "categorie_"+<?= $categorie->categorie_id; ?>;</script>

                            <div id="collapse_<?= $sous_categorie->categorie_id ?>" class="collapse " aria-labelledby="headingOne2" data-parent="#accordionExample">
                                <div class="card-body">
                                    <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <!-- Ceci sers a transformer les categories sans sous-categories en liens (e.g: a donner) -->
                    <script>
                          var nouvelId_filtre = "categorie_"+<?= $categorie->categorie_id; ?>;
                          if(nouvelId_filtre != id_filtre) {
                              var texte = $("#"+nouvelId_filtre+":first-child").text();
                              var html = '<a href="<?= $this->url('annonces/cat/'.$categorie->categorie_id) ?>"';
                              html    += 'class="btn btn-link">'+texte+'</a>';
                              $("#"+nouvelId_filtre+":first-child").html(html);
                          }
                      </script>

                </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
        <?php endif; ?>

        <?php if (isset($id_sous_cat)) : ?>
        <label for="sous-categorie"> categorie :</label>
        <div class=" categorie_liste accordion" id="accordionExample">

            <?php foreach ($sous_categories as $sous_categorie) : ?>
                <?php if ($sous_categorie->sous_categorie_id == $id_sous_cat) : ?>
                <div class="card">
                    <div class="card-header pl-0" id="headingOne">
                        <p class="mb-0 ">
                                <a class="dropdown-item font-weight-bolder" href="<?= $this->url('annonces/cat/' . $sous_categorie->categorie_id) ?>"><?= $sous_categorie->categorie_description ?><i class="fas fa-sort-up"></i></a>
                         </p>
                    </div>
                        
                                <div class="card-body pl-4">
                                    <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                </div>
    
                </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
        
        
        <div class="card-header h-10 filtre_bouton" id="headingOne">
                <h4 >
                    <button class="btn btn-link collapsed font-weight-bold pl-0" type="button" data-toggle="collapse" data-target="#filtre-mobile-contenu" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-sort-down"></i> Filtrez <i class="fas fa-sort-down"></i>
                    </button>                      
                </h4>
        </div>
        <div id='filtre-mobile-contenu' class="collapse " aria-labelledby="headingOne" >


            <div class='filtre_contents'>
                <form name="frm"  action="" method="GET">
                    <h5 class='filtre_titles'>Prix</h5>
                        <div class="input-group mb-3">
                            <?php (isset($_GET['prixMin'])) ? $prix = $_GET['prixMin'] : $prix = '';  ?>
                            <input type="number" class="form-control form-control-sm" placeholder="min" name="prixMin" value="<?php echo $prix ?>">
                        </div>

                        <div class="input-group mb-3">
                            <?php (isset($_GET['prixMax'])) ? $prix = $_GET['prixMax'] : $prix = '';  ?>
                            <input type="number" class="form-control form-control-sm" placeholder="max" name="prixMax" value="<?php echo $prix ?>">
                        </div>
                        <input type="submit" name="prix" value="filtrez prix" class="btn btn-success btn-sm"> 

                </form>
            </div>

            <div class='filtre_contents'>
                <form name="frm" action="" method="GET">
                    <h5 class='filtre_titles'>date d'apparition </h5>
                        <div class="input-group mb-3">
                            <?php (isset($_GET['dateMin'])) ? $dateMin = $_GET['dateMin'] : $dateMin = '';  ?>
                            <input type="date" class="form-control form-control-sm" placeholder="min" name="dateMin" value="<?php echo $dateMin ?>">
                        </div>

                        <div class="input-group mb-3">
                            <?php (isset($_GET['dateMax'])) ? $dateMax = $_GET['dateMax'] : $dateMax = '';  ?>
                            <input type="date" class="form-control form-control-sm" placeholder="max" name="dateMax" value="<?php echo $dateMax ?>">
                        </div>
                        <input type="submit" name="date" value='filtrez date' class="btn btn-success btn-sm">
                </form>
            </div>

            <div class='filtre_contents'>
                <h5 class='filtre_titles'> Lieu</h5>
                    <label for="province">Province</label>
                    <select class="form-control form-control-sm" name="province" id="lieuProvince_mobile">
                        <form name="frm" action="" method="GET"><br>
                            <?php foreach ($provinces as $province) : ?>
                                <?php if (isset($_GET['province'])) $province_id = $_GET['province'];
                                else $province_id = 0 ?>
                            
                                <option value="<?= $province->province_id ?>" <?= ($province_id == $province->province_id) ? "selected" : "" ?>><?= $province->province ?></option>
                            <?php endforeach ?>
                        </select><br>
                        <label for="ville">Ville</label><br>
                        <select class="form-control form-control-sm" name="ville" id="lieuVille_mobile">
                            <?php foreach ($provinces as $province) : ?>
                                <?php foreach ($villes as $ville) : ?>
                                    <?php if ($province->province_id == $ville->province_id) : ?>
                                        <?php if (isset($_GET['ville'])) $ville_id = $_GET['ville'];
                                        else $ville_id = 0 ?>
                                    
                                        <option value="<?= $ville->ville_id ?>" <?= ($ville_id == $ville->ville_id) ? "selected" : "" ?>><?= $ville->ville ?></option>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            <?php endforeach ?>

                        </select>

                        <br><br>
                        <input type="submit" name="chercherLieu" value="chercher" class="btn btn-success btn-sm">
                    </form>
                </div>
        </div>


</div>

    <div id="annonces">

        
        <?php foreach ($annonces as $annonce) : ?>
            <div class="annonce row p-3 d-flex flex-row ">
                <div class='img_parent col-sm-3'>
                    <a href="<?=$this->url('annonces/'.$annonce->annonce_id)?>">
                        <img class='annonce_img' src='<?= $annonce->image_url ?>'>
                     </a>
                </div>
                <div class='annonce-content  col-sm-9'>
                    <div class=' annonceHeader'>
                        <div class="annonceTitrePrix">
                                <a href="<?=$this->url('annonces/'.$annonce->annonce_id)?>">
                                    <h4 class='titre'> <?= $annonce->annonce_titre ?> </h4>
                                    <h4 class='prix' ><?php $prix = ($annonce->annonce_prix > 0) ? $annonce->annonce_prix."$" : "Gratuit"; ?><?= $prix; ?></h4>
                                </a>
                        </div>
                                    <?php $url = $_SERVER['REQUEST_URI']; ?>
                            <?php if($this->usagerConnecte()):?>
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
                                <?php endif?>  
                                    
                                    
                        </div>
                        <div class=' d-flex justify-content-between'>
                            <p class='ville'><?= $annonce->usager_date ?></p>
                            <p class='date'> <?= $annonce->ville ?></p>
                        </div>
                        <p class='description'> <?= $annonce->annonce_description ?></p>
                    
                </div>
            </div>

        <?php endforeach ?>


    </div>

</div>