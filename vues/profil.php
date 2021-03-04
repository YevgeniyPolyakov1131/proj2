<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<?php

$this->titre = "profil";


?>

<div class="container  emp-profile">
            <form method="post">
                <div class="imageProfile_container">
                        <div class="profile-img">
                             <div class='profile_img_parent' id='profile_img_parent'>
                                <img id="photoProfil" src="<?= $this->url($usager->usager_photo_url)?>" alt=""/>
                             </div>
                            <div class="file btn btn-lg btn-primary">
                                 <i class="far fa-images"> </i>Modifier image
                                <input type="file" class='btn btn-dark' name="profilePicture" id="profilePicture"/>
                            </div>
                        </div>
                        <p class='img_txt'></p>
                </div>

                <script>
                    // $(document).ready(function(){

                    //     $('#profilePicture').change(function(){

                    //         var property = document.getElementById('profilePicture').files[0];
                    //         var image_name = property.name;
                    //         var image_extension = image_name.split(".").toLowercase();


                    //         console.log(property);

                    //     });
                    // });

                </script>
                <div class="tab-content profile-tab" id="myTabContent">
                    <h3>Informations Personnelles</h3>
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row-info">
                            <div class="">
                                <label>User Id</label>
                            </div>
                            <div class="">
                                <p><?=$usager->usager_id?></p>
                            </div>
                        </div>
                        <div class="row-info">
                            <div class="">
                                <label>Nom</label>
                            </div>
                            <div class="">
                                <p><?= $usager->usager_prenom." ".$usager->usager_nom?></p>
                            </div>
                        </div>
                        <div class="row-info">
                            <div class="">
                                <label>Email</label>
                            </div>
                            <div class="">
                                <p><?=$usager->usager_courriel?></p>
                            </div>
                        </div>
                        <div class="row-info">
                            <div class="">
                                <label>Phone</label>
                            </div>
                            <div class="">
                                <p><?=$usager->usager_telephone?></p>
                            </div>
                        </div>
                        <div class="row-info">
                            <div class="">
                                <label>code postal</label>
                            </div>
                            <div class="">
                                <p><?=$usager->usager_localite?></p>
                            </div>
                        </div>

                        <div class="editProfile">
                            <a class="profile-edit-btn" href="<?=$this->url('modifier/compte')?>" value="Edit Profile"> modifier Profil</a>
    
                        </div>
                    </div>
                    
                </div>
            </form>           
        </div>