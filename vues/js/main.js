let gestionChats = function() {

	const BASE_URI = "http://localhost/project_web2/";


	var sessionUser;
	var numDiffusion = 1;

	let oGestionChats = {


/* ------------- Récupération  de la liste des messages  (ajax) ------------- */


		listerChats() {


			$.get({url:BASE_URI + "chats", cache:false}).
				done((chatsJson) => {
					let chats = JSON.parse(chatsJson);
					console.log(chats);
						this.afficherchats(chats);
					}).
					fail(this.afficherErreur);
			
				///=============		timer  d'affichage			======================//

				var tid = setInterval(mycode.bind(this), 10000);
					function mycode() {

						$.get({url:BASE_URI+"chats", cache:false}).
						done((chatsJson) => {
							let chats = JSON.parse(chatsJson);
								this.afficherchats(chats);
							}).
							fail(this.afficherErreur);
						}
				//============= 	  recuperation du formulaire	   ====================//

				let t2 = $("#chat_view").prop("content");
					let formClone = t2.cloneNode(true).lastElementChild;
					$("#wrapperForm").append(formClone);
					
				//=============		evenement click	d'ajout de message		============//
					
					let champVide = "veuillez remplir le champ";
					
				$('#bValider').click(()=> {
					(frm.chat_content.value !== "") ? this.verifierUser() : $(".vide").html(champVide) ;
					
				});
		},

/* ------------- Récupération  de la liste des compteurs  (ajax) ------------ */

		listerCompteur() {

				$.get({url:BASE_URI+"compteur", cache:false}).
				done((compteurJson) => {
					let compteur = JSON.parse(compteurJson);
				}).
				fail(this.afficherErreur);
		}, 

/* ------------ verification de  l'existance de l'utilisateur    ------------ */

	// 	verifierUser(){

	// 		$(".vide").html("");
	// 		(sessionStorage.getItem("utilisateur") === null) ? this.ajouterCompteur(numDiffusion) : this.userExiste();

	//    },

/* -------------- confirmation de l'existance du user et envoie ------------- */

		userExiste(){

			sessionUser = sessionStorage.getItem("utilisateur");

				let donnees = {
						chat_content:    	 frm.chat_content.value,
						Chat_webdiffusion:	 numDiffusion,
						Chat_user:         	 "U" + sessionUser,
				}

				this.ajouterChat(donnees);

		},

/* --------------------------- ajout d'utilisateur -------------------------- */
	
		ajouterCompteur(numDiffusion){

				let webDiffusion = {numero_webdiffusion : numDiffusion};

				  $.ajax({url:BASE_URI+"compteur", data: webDiffusion, type:"POST"}).
				  done((reponseJson) => {
						  
					// préparation d'un message de compte-rendu

						let reponse = JSON.parse(reponseJson);
						var user = reponse['chats'].slice(-1)[0].compteur;
						
						sessionStorage.setItem("utilisateur", user);
						this.userExiste();
						
				  }).fail(this.afficherErreur);
			

		},

/* ---------------------------- ajout de message ---------------------------- */

		ajouterChat(donnees){
					
					$.ajax({url:BASE_URI + "chats", data: donnees, type:"POST"}).
					done((reponseJson) => {

						// préparation d'un message de compte-rendu

						let reponse = JSON.parse(reponseJson);
						let ret = "message" + (!reponse['ret'] ? " non" : "") + " envoyé.";  
						this.afficherchats(reponse["chats"], ret); 

					}).
					fail(this.afficherErreur);
					frm.chat_content.value = "";



		},

/* ------------------------- affichage des messages ------------------------- */
		
		afficherchats(chats,ret) {

					///==============    réinitialisation de la zone d'affichage dynamique 	==============//

					$(".ret").html("");
					$("#wrapperChat").html("");	
					$(".vide").html("")				

					///==============     insertion de chaque ligne à partir d'un template  	==============//

					let t2 = $("#chat_view").prop("content");
					$(".ret").html(ret);

					$.each(chats , (i, c) => {

							let t2Clone = t2.cloneNode(true).firstElementChild;
							$(t2Clone).html(eval("`"+$(t2Clone).html()+"`"));
							$("#wrapperChat").append(t2Clone);
					});

					//=============  défilement de la page vers le bas au chargement et a l'ajout ============//

					$('#wrapperChat').animate({
						scrollTop: $('#wrapperChat')[0].scrollHeight}, 2000);


			
		},
	}
	return oGestionChats;
}();