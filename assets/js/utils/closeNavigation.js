window.addEventListener( 'load', () => {

    /**
     * Fermeture ecran de recherche
     */
    const btnCloseSearch = document.getElementById( 'btn-close-search' );
    const searchScreen = document.querySelector( '.searchScreen' );

    btnCloseSearch.addEventListener( 'click', () => {
        searchScreen.classList.add( 'd-none' );
    });

    /**
     * Fermeture box alert
     */
    const btnCloseAlert = document.getElementById( 'btn-close-alert' );
    const alertMessage = document.querySelector( '.object-alert' );

    btnCloseAlert.addEventListener( 'click', () => {
        alertMessage.classList.add( 'd-none' );
    });

    /**
     * Ouverture main nav
     */
    const btnOpenMainNav = document.getElementById( 'btn-open-main-nav' );
    const mainNav = document.getElementById( 'main-nav' );

    btnOpenMainNav.addEventListener( 'click', () => {
        mainNav.classList.add( 'toggle-opened' );
        mainNav.classList.add( 'd-block' );
    });

    /**
     * Fermeture main nav
     */
    const btnCloseMainNav = document.getElementById( 'btn-close-main-nav' );

    btnCloseMainNav.addEventListener( 'click', () => {
        mainNav.classList.add( 'd-none' );
        mainNav.classList.remove( 'toggle-opened' );
        mainNav.classList.remove( 'd-block' );
    });

    /**
     * Fermeture sub nav
     */
    const btnCloseSubNav = document.querySelector( '.btn-close-sub-nav' );
    const subNav = document.querySelector( '.titi' );

    btnCloseSubNav.addEventListener( 'click', () => {
        console.log( 'clicked btn sub ' );
        console.log( subNav );
        subNav.classList.add( 'd-none' );
        subNav.classList.remove( 'toggle-opened' );
        subNav.classList.remove( 'd-block' );
    });
});

//La partie ci-dessus est responsable de la fermeture de la navigation principale
//La classe toggle-opened est presente par defaut et provoque l'ouverture de la page
//Enlever la classe manuellement ferme la page
//clicker sur la croix pour enlever la classe fonctionne correctement mais ne ferme pas la navigation

// TEST -----------------------------------------------------
// let closeSecondNav = document.querySelectorAll(".closeSecondNav");
// let secondNav = document.querySelectorAll(".secondNav");

// closeSecondNav.forEach((elem) => {
//   elem.addEventListener("click", () => {
//     console.log("clicked");
//     secondNav.forEach((el) => {
//       el.style.display = "none";
//     });
//   });
// });

// TEST -----------------------------------------------------
