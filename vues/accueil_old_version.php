<?php

$this->titre = "Accueil";

?>

<div id='containt' class="row mt-5 mb-3 justify-content-center">



<div id="filtre">
        <h4 >Filtrez</h4>
        <div class=" filtre_contents accordion" id="accordionExample">
            <h5 class='filtre_titles'>categories :</h5>
            <?php foreach ($categories as $categorie) : ?>
                <div class="card">
                    <div class="card-header h-10" id="headingOne">
                        <h2 class="mb-0" id="categorie_<?= $categorie->categorie_id; ?>">
                            <button class="btn btn-link collapsed font-weight-bold pl-0 w-100" type="button" data-toggle="collapse" data-target="#collapse_<?= $categorie->categorie_id ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $categorie->categorie_description ?>
                            </button>
                        </h2>
                    </div>
                    <?php foreach ($sous_categories as $sous_categorie) : ?>
                        <?php if ($sous_categorie->categorie_id == $categorie->categorie_id) : ?>
                            <!-- Ceci sers a marquer les les categories qui ont des sous-categories -->
                            <script>var id = "categorie_"+<?= $categorie->categorie_id; ?>;</script>

                            <div id="collapse_<?= $sous_categorie->categorie_id ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <a class="dropdown-item" href="<?= $this->url('annonces/souscat/' . $sous_categorie->sous_categorie_id) ?>"><?= $sous_categorie->sous_categorie_description ?></a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <!-- Ceci sers a transformer les categories sans sous-categories en liens (e.g: a donner) -->
                            
                </div>
            <?php endforeach ?>
        </div>








        <div class='filtre_contents'>
            <h5 class='filtre_titles'>Prix</h5>
                <h6>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control form-control-sm" placeholder="de" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">

                        <input type="text" class="form-control form-control-sm" placeholder="à" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <input type="submit" class="btn btn-success btn-sm">
        </div>

        <div class='filtre_contents'>
            <h5 class='filtre_titles'>Anne </h5>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control form-control-sm" placeholder="de" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">

                        <input type="text" class="form-control form-control-sm" placeholder="à" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <input type="submit" class="btn btn-success btn-sm">
        </div>

        <div class='filtre_contents'>
            <h5 class='filtre_titles'> Lieu</h5>
                <label for="province">Province</label>
                <select class="form-control form-control-sm" name="province" id="lieuProvince">
                    <form action="" method="GET"><br>
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

                    <br><br>
                    <input type="submit" name="chercherLieu" value="chercher" class="btn btn-success btn-sm">
                </form>
            </div>


</div>


<div id="filtre-mobile" class="col-sm-12 accordion">
<div class="card-header h-10" id="headingOne">
        <h4 >
            <button class="btn btn-link collapsed font-weight-bold pl-0" type="button" data-toggle="collapse" data-target="#filtre-mobile-contenu" aria-expanded="true" aria-controls="collapseOne">
            Filtrez
            </button>                      
        </h4>
    </div>
        <div id='filtre-mobile-contenu' class="collapse " aria-labelledby="headingOne" >

            <div class='filtre_contents'>
                <h5 class='filtre_titles'>Prix</h5>
                    <h6>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control form-control-sm" placeholder="de" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">

                            <input type="text" class="form-control form-control-sm" placeholder="à" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <input type="submit" class="btn btn-success btn-sm">
            </div>

            <div class='filtre_contents'>
                <h5 class='filtre_titles'>Anne </h5>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control form-control-sm" placeholder="de" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">

                            <input type="text" class="form-control form-control-sm" placeholder="à" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <input type="submit" class="btn btn-success btn-sm">
            </div>

            <div class='filtre_contents'>
                <h5 class='filtre_titles'> Lieu</h5>
                    <label for="province">Province</label>
                    <select class="form-control form-control-sm" name="province" id="lieuProvince">
                        <form action="" method="GET"><br>
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

                        <br><br>
                        <input type="submit" name="chercherLieu" value="chercher" class="btn btn-success btn-sm">
                    </form>
                </div>
        </div>


</div>

<div id="annonces">

    <?php
    if (isset($_GET['page'])) {

        $page = ($_GET['page'] - 1);
    } else $page = 0;

    echo $annonces->links();

    ?>
    <?php foreach ($annonces->page($page) as $annonce) : ?>
        <div class="annonce  row p-3 d-flex flex-row ">
                <div class='img_parent col-sm-3'>
                     <img class='annonce_img' src='<?= $annonce->image_url ?>'>
                </div>
                <div class='annonce-content  col-sm-9'>
                    <div class='d-flex flex-row justify-content-between '>
                        <h4 class='titre'> <?= $annonce->annonce_titre ?> </h4>
                        <h4 class='prix' ><?php $prix = ($annonce->annonce_prix > 0) ? $annonce->annonce_prix."$" : "Gratuit"; ?>
                            <?= $prix; ?></h4>
                    </div>
                    <div class='location_date d-flex     justify-content-between'>
                        <p class='ville'> <?= $annonce->ville ?></p>
                        <p class='date'><?= $annonce->usager_date ?></p>
                    </div>
                    <p class='description'> <?= $annonce->annonce_description ?></p>
                 </div>
        </div>

    <?php endforeach ?>

    <?= $annonces->links() ?>


</div>

</div>