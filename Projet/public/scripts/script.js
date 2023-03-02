const modalAuteur = document.querySelector("#modalAuteur");
const modalEditeur = document.querySelector("#modalEditeur");
const modalGenre = document.querySelector("#modalGenre");

const btn = document.querySelector("#btnModal");
const btn2 = document.querySelector("#btnModal2");
const btn3 = document.querySelector("#btnModal3");
const btnPlus = document.querySelector("#btnPlus");

const span = document.querySelector("#close");
const span2 = document.querySelector("#close1");
const span3 = document.querySelector("#close2");


// Ouverture
btn.addEventListener('click', function() {
  modalAuteur.style.display = "block";
})
btn2.addEventListener('click', function() {
  modalEditeur.style.display = "block";
})
btn3.addEventListener('click', function() {
  modalGenre.style.display = "block";
})
// Fermeture 
span.addEventListener('click', function() {
  modalAuteur.style.display = "none";
})
span2.addEventListener('click', function() {
  modalEditeur.style.display = "none";
})
span3.addEventListener('click', function() {
  modalGenre.style.display = "none";
})

// Fermeture en cliquant en dehors
window.addEventListener('click', function(event) {
  if (event.target == modalAuteur) {
    modalAuteur.style.display = "none";
  }
})
window.addEventListener('click', function(event) {
  if (event.target == modalEditeur) {
    modalEditeur.style.display = "none";
  }
})
window.addEventListener('click', function(event) {
  if (event.target == modalGenre) {
    modalGenre.style.display = "none";
  }
})

// Boutton Plus (ajouter un nouveau champ d'ajout d'auteur dans une modal)
btnPlus.addEventListener('click', function(){
  const para = modalAuteur.createElement("p"); 
  const nom = modalAuteur.createTextNode("nom");
  
  para.appendChild(nom);
  modalAuteur.appendChild(para);
 
});


// Ajout d'un nouvel auteur
if (document.querySelector('#btnSubmitAuteur')){
  let btnSubmitAuteur = document.querySelector('#btnSubmitAuteur');
  btnSubmitAuteur.addEventListener('click', function() {
    //Appeler en asynchrone la chemin index.php?page=api&action=ajoutauteur
    //En réutilisant les 2 champs de saisie transmis en post
    
    let chNom = document.querySelector('#modal-prenomAuteur');
    let chPrenom = document.querySelector('#modal-nomAuteur');
    
    if (chNom.value.trim() != '' && chPrenom.value.trim() != ''){
      myFormData = new FormData();
      myFormData.append('nomAuteur', chNom.value);
      myFormData.append('prenomAuteur', chPrenom.value);
      
      fetch('index.php?page=api&action=ajoutauteur', {
        method: 'POST',
        body: myFormData
      }).then(function(reponse){
        
        reponse.json()
        .then(function(data){
          console.log('Je reçois : ', data);
          
          document.querySelector('#champAuteur').value = data.nomComplet;
          chNom.value = '';
          chPrenom.value = '';
          modalAuteur.style.display = "none";
        }).catch(function(){
          console.log('Erreur sur le dejsonify');
        })
        
      }).catch(function(){
        console.log('Erreur sur le fetch');
      })
    }
  })
}

// Ajout d'un nouvel éditeur
if (document.querySelector('#btnSubmitEditeur')){
  let btnSubmitEditeur = document.querySelector('#btnSubmitEditeur');
  btnSubmitEditeur.addEventListener('click', function(){
    let chNom = document.querySelector('#modal-editeur');
    
    if (chNom.value.trim() != ''){
      myFormData = new FormData();
      myFormData.append('nom', chNom.value);
      
      fetch('index.php?page=api&action=ajoutediteur', {
        method: 'Post',
        body: myFormData
      }).then(function(reponse){
        reponse.json()
        .then(function(data){
          
          document.querySelector('#champEdition').value = data.nom;
          chNom = '';
          modalEditeur.style.display = "none";
        }).catch(function(){
          console.log('Erreur sur le dejsonify');
        })  
      }).catch(function(){
        console.log('Erreur sur le fetch');
      })
    }
  })
}

// Ajout d'un nouveau genre
if (document.querySelector('#btnSubmitGenre')){
  let btnSubmitGenre = document.querySelector('#btnSubmitGenre');
  btnSubmitGenre.addEventListener('click', function(){
    let chLibelle = document.querySelector('#modal-genre');

    if (chLibelle.value.trim() != ''){
      myFormData = new FormData();
      myFormData.append('libelle', chLibelle.value);
      
      fetch('index.php?page=api&action=ajoutgenre', {
        method: 'Post',
        body: myFormData
      }).then(function(reponse){
        reponse.json()
        .then(function(data){
          
          document.querySelector('#champGenre').value = data.libelle;
          chLibelle = '';
          modalGenre.style.display = "none";
        }).catch(function(){
          console.log('Erreur sur le dejsonify');
        })
      }).catch(function(){
        console.log('Erreur sur le fetch');
      })
    }
  })
}

// Ajout d'un input Auteur
const btnInput = document.querySelector('#btnInput');
const champAuteur = document.querySelector('#champAuteur');
let inputCount = 0;
btnInput.addEventListener('click', function(){
  inputCount++;

  const newInput = document.createElement('input');
  newInput.type = 'list';
  newInput.name = 'chAuteur[]' + inputCount;
  newInput.id = 'champAuteur' + inputCount;
    
  champAuteur.appendChild(newInput);
})

// Select Langue
// Si la langue n'est pas sélectionnée -> alert -> focus (revient sur le champ langue)

let form = document.querySelector("form");

form.addEventListener('submit', function(event) {
    event.preventDefault();
    let champLangue = document.querySelector('#champLangue');
    
    if (champLangue.selectedIndex == 0){
      alert("choisir langue");
      champLangue.focus();
    }
    else{
      form.submit();
    }
})