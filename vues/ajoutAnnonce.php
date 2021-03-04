<?php

$this->titre = "ajouter Annonce";

// $images = json_decode($annonce->image_description_big);

?>


<div class="row mt-50 mb-5 p-1 justify-content-center">
    <form action="" method="POST" class="form_ajouter_modifier" enctype="multipart/form-data">
        <h1>Ajouter un annonce</h1>

        <div class="form-group">
            <label for="annonce_titre">Titre</label>
            <input name="annonce_titre" type="text" class="form-control <?php if(isset($data->annonce_titre_error)) echo 'is-invalid'?>" id="titre" aria-describedby="titre" placeholder="Entrez titre" value="<?php if(isset($data->annonce_titre)) echo $data->annonce_titre?>">
            
            <?php if(isset($data->annonce_titre_error)): ?>
            <div class="invalid-feedback"><?=$data->annonce_titre_error?></div>
            <?php endif?>
        </div>    

        <div class="form-group">
            <label for="annonce_description">Description</label>
            <textarea name="annonce_description" cols="30" rows="10" class="form-control <?php if(isset($data->annonce_description_error)) echo 'is-invalid'?>" placeholder="Entrez description"><?php if(isset($data->annonce_description)) echo $data->annonce_description?></textarea>
                        
            <?php if(isset($data->annonce_description_error)): ?>
            <div class="invalid-feedback"><?=$data->annonce_description_error?></div>
            <?php endif?>
        </div> 

        <div class="form-group">
            <label for="annonce_prix">Prix</label>
            <input name="annonce_prix" type="number" class="form-control <?php if(isset($data->annonce_prix_error)) echo 'is-invalid'?>" id="prix" aria-describedby="prix" placeholder="Entrez prix" value="<?php if(isset($data->annonce_prix)) echo $data->annonce_prix?>">
            
            <?php if(isset($data->annonce_prix_error)): ?>
            <div class="invalid-feedback"><?=$data->annonce_prix_error?></div>
            <?php endif?>
        </div> 

        <div class="form-group">
            <label for="ville_id">Ville</label>
            <select name="ville_id" class="form-control <?php if(isset($data->ville_id_error)) echo 'is-invalid'?>" id="ville">
            <?php foreach($villes as $ville):?>

            <?php if($ville->ville_id == $data->ville_id):?>    
            <option value="<?=$ville->ville_id?>" selected> <?=$ville->ville?></option>
            <?php else:?>
            <option value="<?=$ville->ville_id?>"> <?=$ville->ville?></option>
            <?php endif?>

            <?php endforeach?>    
            </select>
                        
            <?php if(isset($data->ville_id_error)): ?>
            <div class="invalid-feedback"><?=$data->ville_id_error?></div>
            <?php endif?>
        </div>   

        <div class="form-group">
            <label for="sous_categorie_id">Sous-categorie</label>
            <select name="sous_categorie_id" class="form-control <?php if(isset($data->sous_categorie_id_error)) echo 'is-invalid'?>" id="sous_categorie">
            <?php foreach($sous_categories as $sous_categorie):?>

            <?php if($sous_categorie->sous_categorie_id == $data->sous_categorie_id):?>    
            <option value="<?=$sous_categorie->sous_categorie_id?>" selected> <?=$sous_categorie->sous_categorie_description?></option>
            <?php else: ?>
            <option value="<?=$sous_categorie->sous_categorie_id?>"> <?=$sous_categorie->sous_categorie_description?></option>
            <?php endif ?>

            <?php endforeach?>    
            </select>
                        
            <?php if(isset($data->sous_categorie_id_error)): ?>
            <div class="invalid-feedback"><?=$data->sous_categorie_id_error?></div>
            <?php endif?>
        </div> 

        <input type="hidden" name="usager_id" value="<?=$this->getUsagerId()?>">
        <input type="hidden" name="usager_date" value="">                

        <div class="form-group">
            <label for="img_base">Image principale</label>
            <div class="custom-file mt-3 mb-5">
                <input type="file" class="custom-file-input" id="img_base" name="img_base">
                <label class="custom-file-label" for="img_base">Image principale</label>
                <div class="box_image_preview row mb-5 mt-3">
                    <img>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="but_submit">Ajouter</button>
    </form>

</div>


<!-------------------------------- TEMPLATE -------------------------------->


<template id='t_image_supplementaire'>
    <div class="form-group">
        <label for="img_${ind}">Image supplémentaire</label>
        <div class="custom-file mt-3 mb-5">
            <input type="file" class="custom-file-input" id="img_${ind}" name="img_${ind}">
            <label class="custom-file-label" for="img_${ind}">Image supplémentaire</label>
            <div class="box_image_preview row mb-5 mt-3">
                <img>
            </div>
        </div>
    </div>
</template>



 <!------------------------------------------------------------------------->


<script>
// Add the following code if you want the name of the file appear on select
$("form").on("change", function(evt) {

  if($(evt.target).attr('class')=='custom-file-input'){  

    var fileName = $(evt.target).val().split("\\").pop(); 
    $(evt.target).siblings(".custom-file-label").addClass("selected").html(fileName);
    let imgCourant = $(evt.target).parent().children('div').children('img');

    if(evt.target.files && evt.target.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            imgCourant
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(evt.target.files[0]);
    }

    let ind;
    if(evt.target.id == 'img_base'){ 
        ind = 1; 
    }else{
        ind = parseInt(evt.target.id.slice(-1))+1;
    }
    
    if(ind < 6){
        if($(evt.target).parent().parent().next().attr('type')=="submit"){
        let templ = $('#t_image_supplementaire').clone().html();
        $('#but_submit').before(eval("`"+templ+"`"));
        }
    }
    
}
  

});


</script>