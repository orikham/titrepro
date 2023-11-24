/**********HEADER-JS**********/
//menus burger
document.addEventListener("DOMContentLoaded", function(){
  const svg = document.getElementById("svg-header");
const menusM = document.getElementById("menus-m");

svg.addEventListener("click",() =>{
  if (menusM.style.display === "block") {
    menusM.style.display = "none";
  } else {
    menusM.style.display = "block";
  }
});
})


/**********JS-SECTION-ACCUEIL**********/
//slider de l'accueil
document.addEventListener("DOMContentLoaded", function() {
    
    const carouselItems = document.querySelectorAll(".carouselItem");
    const boutonGauche = document.getElementById("bouton-gauche");
    const boutonDroit = document.getElementById("bouton-droit");
  
    let currentIndex = 0;
    const isMobile = window.innerWidth <= 768;
    // Fonction pour afficher la carte actuelle
    function showCard(index) {
      // Masquez toutes les cartes
      carouselItems.forEach(item => {
        item.style.display = "none";
      });
  
      // Affichez la carte actuelle
      carouselItems[index].style.display = "block";
    }
  
    // bouton suivant
    boutonDroit.addEventListener("click", function() {
      if (isMobile) {
        // En mode mobile, passe directement de slide 1 à slide 3
        currentIndex = currentIndex === 0 ? 2 : 0;
      } else {
        currentIndex++;
        if (currentIndex >= carouselItems.length) {
          currentIndex = 0;
        }
      }
      showCard(currentIndex);
    });
  
    // bouton précédent
    boutonGauche.addEventListener("click", function() {
      if (isMobile) {
        // En mode mobile, passe directement de slide 1 à slide 3
        currentIndex = currentIndex === 0 ? 2 : 0;
      } else {
        currentIndex--;
        if (currentIndex < 0) {
          currentIndex = carouselItems.length - 1;
        }
      }
      showCard(currentIndex);
    });
  
    // Affichez la première carte au chargement de la page
    showCard(currentIndex);

    
  });

//animation de la présentation dans l'accueil
window.addEventListener("scroll", function(){

  var scrollPosition = this.window.scrollY;

  if (scrollPosition > 300) {
    document.getElementById("bio").classList.toggle("gauche");
  }
});


/**********JS-SECTION-PRESTATION**********/

//animation des sous categorie au clic de la category 
document.addEventListener("DOMContentLoaded", function(){
  const categories = document.getElementsByClassName('categorie-title');
  const sousCategories = document.getElementsByClassName('menus-sous-cat');

  for (let i = 0; i < categories.length; i++) {
    categories[i].addEventListener("mouseenter", function() {
      fadeIn(sousCategories[i]);
    });

    categories[i].addEventListener("mouseleave", function() {
      fadeOut(sousCategories[i]);
    });
  }
});

function fadeIn(element) {
  element.style.display = 'flex';
  let opacity = 0;

  function increaseOpacity() {
    if (opacity < 1) {
      opacity += 0.3;
      element.style.opacity = opacity;
      requestAnimationFrame(increaseOpacity);
    }
  }

  increaseOpacity();
}

function fadeOut(element) {
  let opacity = 1;

  function decreaseOpacity() {
    if (opacity > 0) {
      opacity -= 0.1;
      element.style.opacity = opacity;
      requestAnimationFrame(decreaseOpacity);
    } else {
      element.style.display = 'none';
    }
  }

  decreaseOpacity();
}




  