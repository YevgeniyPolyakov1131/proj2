<?php

$this->titre = "modifier usager";

?>

<div class=" inscription-modification  w-100 row mt-5 mb-5 justify-content-center" id="modifUser">

    <form method = "post">
        <h1>Modifier Compte</h1>

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input name="usager_nom" type="text" pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]{3,30}" oninvalid="this.setCustomValidity('Min 3 et Max 20 lettres sans chiffre et sans caractères spéciaux')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_nom_error)) echo 'is-invalid'?>" id="nom" aria-describedby="emailHelp" placeholder="Entrez votre nom" value="<?= (isset($data->usager_nom)) ?  $data->usager_nom :  $usager->usager_nom ;?>">
            
            <?php if(isset($data->usager_nom_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_nom_error?></div>
            <?php endif?>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input name="usager_prenom" type="text" pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]{3,30}" oninvalid="this.setCustomValidity('Min 3 et Max 20 lettres sans chiffre et sans caractères spéciaux')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_prenom_error)) echo 'is-invalid'?>" id="prenom" aria-describedby="emailHelp" placeholder="Entrez votre prénom" value="<?= (isset($data->usager_prenom)) ? $data->usager_prenom : $usager->usager_prenom ;?>">
            
            <?php if(isset($data->usager_prenom_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_prenom_error?></div>
            <?php endif?>
        </div>                

        <div class="form-group">
            <label for="email">Courriel :</label>
            <input name="usager_courriel" type="email" class="form-control <?php if(isset($data->usager_courriel_error)) echo 'is-invalid'?>" id="email" aria-describedby="emailHelp" placeholder="Entrez votre courriel" value="<?= (isset($data->usager_courriel)) ? $data->usager_courriel :  $usager->usager_courriel ;?>">
            
            <?php if(isset($data->usager_courriel_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_courriel_error?></div>
            <?php endif?>
        </div>

        <div class="form-group">
            <label for="prenom">Télephone :</label>
            <input name="usager_telephone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninvalid="this.setCustomValidity('Doit respeter le format 123-456-7890')" oninput="this.setCustomValidity('')"class="form-control <?php if(isset($data->usager_telephone_error)) echo 'is-invalid'?>" id="telephone" aria-describedby="emailHelp" placeholder="123-456-7890" value="<?= (isset($data->usager_telephone)) ? $data->usager_telephone : $usager->usager_telephone ;?>">
            
            <?php if(isset($data->usager_telephone_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_telephone_error?></div>
            <?php endif?>
        </div>           


        <div class="form-group">
            <label for="prenom">code postal :</label>
            <input name="usager_localite" type="text" pattern="[0-9A-Za-z]{3}[ ]{1}[0-9A-Za-z]{3}" oninvalid="this.setCustomValidity('Doit respeter le format H0H 0H0')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_localite_error)) echo 'is-invalid'?>" id="codepostal" aria-describedby="emailHelp" placeholder="K0A 3M0" value="<?= (isset($data->usager_localite)) ? $data->usager_localite : $usager->usager_localite ;?>">
            
            <?php if(isset($data->usager_localite_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_localite_error?></div>
            <?php endif?>
        </div>           
       



        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>  



</div>