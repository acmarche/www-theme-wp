window.addEventListener( 'load', () => {

    /**
     * Fermeture ecran de recherche
     */
    const btnCloseSearch = document.getElementById( 'btn-close-search' );
    const searchScreen = document.querySelector( '.searchScreen' );
    if ( null != btnCloseSearch ) {
        btnCloseSearch.addEventListener( 'click', () => {
            searchScreen.classList.add( 'd-none' );
        });
    }

    /**
     * Ouverture ecran de recherche
     */
    const btnOpenSearch = document.getElementById( 'btn-open-search' );
    if ( null != btnOpenSearch ) {
        btnCloseSearch.addEventListener( 'click', () => {
            searchScreen.classList.add( 'd-none' );
        });
    }

    /**
     * Fermeture box alert
     */
    const btnCloseAlert = document.getElementById( 'btn-close-alert' );

    if ( null != btnCloseAlert ) {
        const alertMessage = document.querySelector( '.object-alert' );
        btnCloseAlert.addEventListener( 'click', () => {
            alertMessage.classList.add( 'd-none' );
            const date = new Date( Date.now() );
            date.setDate( date.getDate() + 3 );
            document.cookie = `closeAlert=true; expires=${date.toUTCString()}`;
        });
    }

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
