$( document ).ready(function() {

    
    var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/";
    
    const BASE_URI = baseUrl;
    

/* -------------------------------- GET ville ------------------------------- */
    $('#lieuProvince').change(function(evt){
        // eSelect.addEventListener("change", function(evt) {
            $("#lieuVille").html("");
            let provinceId = evt.target.value;
            console.log("ok");
            $.get({
                    url: BASE_URI + "villes/" + provinceId,
                    cache: false
                })
                .done(villeJson => {
                    let villes = JSON.parse(villeJson);
                    // console.log(villes);

                    let eSelect2 = document.querySelector("#lieuVille");
                    $.each(villes, function(index, value) {

                        $("#lieuVille").append(`<option value='${value.ville_id}' >${value.ville}</option>`);
                    });

                })
                .fail(this.afficherErreur);
        });

    $('#lieuProvince_mobile').change(function(evt){
        // eSelect.addEventListener("change", function(evt) {
            $("#lieuVille_mobile").html("");
            let provinceId = evt.target.value;
            console.log("ok");
            $.get({
                    url: BASE_URI + "villes/" + provinceId,
                    cache: false
                })
                .done(villeJson => {
                    let villes = JSON.parse(villeJson);
                    // console.log(villes);

                    let eSelect2 = document.querySelector("#lieuVille_mobile");
                    $.each(villes, function(index, value) {

                        $("#lieuVille_mobile").append(`<option value='${value.ville_id}' >${value.ville}</option>`);
                    });

                })
                .fail(this.afficherErreur);
        });



/* --------------------------- executed fonctions --------------------------- */

    favorisCount()
    getFavoris()
    colorIcons ()

/* ------------------------------- GET favoris count ------------------------------ */

function favorisCount(){
    $.get({
        url: BASE_URI + "favori",
        cache: false
    })
    .done((reponse) => {
        let favoris = JSON.parse(reponse);
        console.log(favoris);

        $("#idCount").html(favoris[0]['nbFavoris'] +"<br>");
        // getFavoris();    

    })
    .fail(this.afficherErreur);

}

/* ------------------------------- GET favoris All ------------------------------ */

function getFavoris() {


    let usager_id  = $('#usager_id').text();    

    $.get({
        url: BASE_URI + "allFavoris",
        cache: false
    })
    .done((reponse) => {
        let favoris = JSON.parse(reponse);

        let t = $("#t_annonce").prop("content");
        $.each(favoris, (i, c) => {
                let tClone = t.cloneNode(true).firstElementChild;
                $(tClone).html(eval("`"+$(tClone).html()+"`"));
                $("#carouselExampleIndicators1").append(tClone);

                $('.ajoutFavoris').each(function(){

                    if($(this).attr('id') == c.annonce_id){


                        $(this).children().removeClass('far').addClass('fas');
                    }
                })
        

        });	
        colorIcons();
        deleteFavoris();



    })
    .fail(this.afficherErreur);

};


/* ------------------------------ POST favoris ------------------------------ */

    $('.ajoutFavoris').click(function(){
        let annonce_id = $(this).attr('id');
        let usager_id  = $('#usager_id').text();

        let favoris = [{
                'usager_id': usager_id,
                'annonce_id': annonce_id
            }];



            $.get({
                url: BASE_URI + "favorisExiste/"+annonce_id,
                cache: false
            })
            .done((reponse) => {

                var favori = JSON.parse(reponse);

                if (jQuery.isEmptyObject(favori)) {

                    $.post({
                        url: BASE_URI+ "favori",
                        type: 'POST',
                        data: favoris[0],
                        dataType: "json",
                    }).
                    done((reponse)=>{
                        // let favoris = JSON.parse(reponse);
                        console.log(reponse);
                        $("#carouselExampleIndicators1").html('');
                        $("#idCount").html(reponse[0]['nbFavoris'] +"<br>");
                        getFavoris();
                        $(this).children().removeClass('far').addClass('fas');
                    }).
                    fail((erreur)=> { 
                        $("#erreur").html("Erreur: " + erreur.status + " " + erreur.statusText);
                    });

                }else{

                    
                    $.ajax({
                        url: BASE_URI+ "favori/"+annonce_id,
                        type: 'DELETE'
                    }).
                    done((reponse)=>{
                        // let favoris = JSON.parse(reponse);
                        console.log(reponse)
                        $(this).children().removeClass('fas').addClass('far');
                        $("#carouselExampleIndicators1").html('');
                        $("#idCount").html('');
                         getFavoris();
                         favorisCount();
                    }).
                    fail((erreur)=> {
                        console.log("Erreur: " + erreur.status + " " + erreur.statusText);
                        $("#erreur").html("Erreur: " + erreur.status + " " + erreur.statusText);
                    });
                }
        
            })
            .fail(this.afficherErreur);        

    });

/* ---------------------------- SUPRIMER favoris ---------------------------- */
function deleteFavoris(){

    $('.suprimerFavoris').click(function(){

        let annonce_id = $(this).attr('id');
        console.log(annonce_id)
        $.ajax({
            url: BASE_URI+ "favori/"+annonce_id,
            type: 'DELETE'
        }).
        done((reponse)=>{

            $("#carouselExampleIndicators1").html('');
            $("#idCount").html('');

            getFavoris();
            favorisCount()

            $('.ajoutFavoris').each(function(){

                if($(this).attr('id') !== $('.suprimerFavoris').each().attr('id')){

                    $(this).children().removeClass('fas').addClass('far');
                }
            })
        }).
        fail((erreur)=> {
            console.log("Erreur: " + erreur.status + " " + erreur.statusText);
            $("#erreur").html("Erreur: " + erreur.status + " " + erreur.statusText);
        });

        

    });
}

function colorIcons (){

/* -------- full heart to empty -------------- */

    $(".far ").mouseenter(function(){
        $(this).removeClass('far');
        $(this).addClass('fas');
    }).mouseleave(function(){
        $(this).removeClass('fas');
        $(this).addClass('far');
    })

/* --------- empty heart to full -------------- */

    $(".fas ").mouseenter(function(){
        $(this).removeClass('fas');
        $(this).addClass('far');
    }).mouseleave(function(){
        $(this).removeClass('far');
        $(this).addClass('fas');
    })
}

/* -------------------------------- carousel -------------------------------- */

$('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  
    for (var i=0;i<4;i++) {
      next=next.next();
      if (!next.length) {
        next=$(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));
    }
  });


/* --------------------------- confirmation delet --------------------------- */


$('.suprimerAnnonce').click(function(){


    let annonce_id = $(this).attr('id');

    $(".modal #deletebouton").val( annonce_id );


});

/* ----------------------------- profile picture ---------------------------- */


$('#profilePicture').change(function(){

    var property = document.getElementById('profilePicture').files[0];
    console.log(property);
    var image_name = property.name;
    var image_extension = image_name.split(".").pop().toLowerCase();
    if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])== -1)
    {
        $('.img_txt').html('fichier d\'image  invalide');

    }
    else
    {
        var image_size = property.size;
        if (image_size > 1000000)
        {
            var calcul = image_size  / 1024 / 1024;
            $('.img_txt').html("la taille de l\'image doit être inferieur à <b>2 MB</b>.<br>  <span>taille actuelle :   <b>"+ calcul.toFixed(2)+" MB </b></span>");
        }
        else
        {
            $('.img_txt').html('')
            var form_data = new FormData();
            form_data.append('file', property)
            // console.log(form_data);
            $.post({
                url: BASE_URI+'profil',
                method: 'POST',
                data: form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('.img_txt').html("<label class='text-success'>l'image s\'enregistre...</label>");
                }
            }).
            done(function(data){

                let usager = JSON.parse(data);
                let photo = BASE_URI+usager.usager_photo_url
                $('.img_txt').html('')
                console.log(window.location.href);
                $('.profile-img img').attr('src', photo);
                // $('#profile_img_parent').load(document.URL + '#profile_img_parent' )

            })

        }
    }




});


});