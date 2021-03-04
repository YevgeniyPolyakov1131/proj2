<?php

$this->titre = "Accueil";

?>


<script src="<?= $this->url('vues/js/main.js') ?>"></script>
  <script>
    window.addEventListener("load", function() {
      gestionChats.listerChats();
    });
  </script>


<h2>CLAVARDAGE</h2>

<div class="container" id="wrapper">
  <div class="container" id="wrapperChat">
 
  </div>
  <div class="container" id="wrapperForm">

  </div>
</div>



<!--  Template liste des clients
	  ==========================
-->

<template id="chat_view">
		<div class="chats">
			<div class="c id">${c.chat_Id} </div>
			<div class="c user">${c.Chat_user}</div>
			<div class="c message">${c.chat_content}</div>
			<div class="c date">${c.chat_date}</div>
    </div>
    <form name="frm" action="" onkeydown="return event.key != 'Enter';">
      <span class='ret'></span>
      <span class='vide'></span>
       <input type="text" placeholder="saisissez un message..." name="chat_content" class ="chatField" required>
       <input type="button" id="bValider" value="envoyez">
    </form>

</template>		
