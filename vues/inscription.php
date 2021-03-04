<?php

$this->titre = "Inscription";

?>

<div class=" inscription-modification row mt-5 mb-5 justify-content-center">

    <form method = "post">
        <h1>Inscription</h1>

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input name="usager_nom" type="text" pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]{3,30}" oninvalid="this.setCustomValidity('Min 3 et Max 20 lettres sans chiffre et sans caractères spéciaux')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_nom_error)) echo 'is-invalid'?>" id="nom" aria-describedby="emailHelp" placeholder="Entrez votre nom" value="<?php if(isset($data->usager_nom)) echo $data->usager_nom?>">
            
            <?php if(isset($data->usager_nom_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_nom_error?></div>
            <?php endif?>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input name="usager_prenom" type="text"  pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]{3,30}" oninvalid="this.setCustomValidity('Min 3 et Max 20 lettres sans chiffre et sans caractères spéciaux')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_prenom_error)) echo 'is-invalid'?>" id="prenom" aria-describedby="emailHelp" placeholder="Entrez votre prénom" value="<?php if(isset($data->usager_prenom)) echo $data->usager_prenom?>">
            
            <?php if(isset($data->usager_prenom_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_prenom_error?></div>
            <?php endif?>
        </div>                

        <div class="form-group">
            <label for="email">Courriel :</label>
            <input name="usager_courriel" type="email" class="form-control <?php if(isset($data->usager_courriel_error)) echo 'is-invalid'?>" id="email" aria-describedby="emailHelp" placeholder="Entrez votre courriel" value="<?php if(isset($data->usager_courriel)) echo $data->usager_courriel?>">
            
            <?php if(isset($data->usager_courriel_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_courriel_error?></div>
            <?php endif?>
        </div>

        <div class="form-group">
            <label for="confirm_email">Confirmez le courriel :</label>
            <input name="usager_courriel_confirm" type="email" class="form-control <?php if(isset($data->usager_courriel_confirm_error)) echo 'is-invalid'?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre courriel" value="<?php if(isset($data->usager_courriel_confirm)) echo $data->usager_courriel_confirm?>">
            <?php if(isset($data->usager_courriel_confirm_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_courriel_confirm_error?></div>
            <?php endif?>            
        </div>        

        <div class="form-group">
            <label for="mdp">Mot de passe :</label>
            <input name="usager_mdp" type="password" pattern="(?=.*[a-z])(?=.*[A-Z]).{6,}" oninvalid="this.setCustomValidity('Minimum 6 caractères d\'au moins une lettre majuscule et minuscule')" oninput="this.setCustomValidity('')" class="form-control <?php if(isset($data->usager_mdp_error)) echo 'is-invalid'?>" id="mdp" placeholder="Mot de passe" value="<?php if(isset($data->usager_mdp)) echo $data->usager_mdp?>">
            <?php if(isset($data->usager_mdp_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_mdp_error?></div>
            <?php endif?>             
        </div>

        <div class="form-group">
            <label for="usager_mdp_confirm">Confirmez mot de passe :</label>
            <input name="usager_mdp_confirm" type="password" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" oninvalid="this.setCustomValidity('Minimum 4 caractères d\'au moins une lettre majuscule et minuscule')" oninput="this.setCustomValidity('')"class="form-control <?php if(isset($data->usager_mdp_confirm_error)) echo 'is-invalid'?>" id="mdp_confirm" placeholder="Mot de passe" value="<?php if(isset($data->usager_mdp_confirm)) echo $data->usager_mdp_confirm?>">
            <?php if(isset($data->usager_mdp_confirm_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_mdp_confirm_error?></div>
            <?php endif?>             
        </div>


        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>  



</div>

<!-- minimum 6 caractères d'au moins une lettre majuscule et minuscule -->