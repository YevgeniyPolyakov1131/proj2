<?php

$this->titre = "Connexion";

?>

<div class=" inscription-modification row mt-5 mb-5 justify-content-center">

    <form method = "post">
        <h1>Connexion</h1> 

        <div class="form-group">
            <label for="email">Courriel :</label>
            <input name="usager_courriel" type="email" class="form-control <?php if(isset($data->usager_courriel_error)) echo 'is-invalid'?>" id="email" aria-describedby="emailHelp" placeholder="Entrez votre courriel" value="<?php if(isset($data->usager_courriel)) echo $data->usager_courriel?>">
            
            <?php if(isset($data->usager_courriel_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_courriel_error?></div>
            <?php endif?>
        </div>

        <div class="form-group">
            <label for="mdp">Mot de passe :</label>
            <input name="usager_mdp" type="password" class="form-control <?php if(isset($data->usager_mdp_error)) echo 'is-invalid'?>" id="mdp" placeholder="Mot de passe" value="<?php if(isset($data->usager_mdp)) echo $data->usager_mdp?>">
            <?php if(isset($data->usager_mdp_error)): ?>
            <div class="invalid-feedback"><?=$data->usager_mdp_error?></div>
            <?php endif?>             
        </div>

        <button type="submit" class="btn btn-primary">Log in</button>
    </form>  



</div>