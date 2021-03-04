<?php

class Ville
{
    function getVillesParProvince($id)
    {

        $villes = Villes::getVillesByProvince($id);

        echo json_encode($villes);
    }
}
