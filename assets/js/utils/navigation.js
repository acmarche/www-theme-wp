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
    const mainToggle = document.getElementById( 'main-toggle' );//pour faire suivant infographiste mais marche pas
    const btnOpenMainNav = document.getElementById( 'btn-open-main-nav' );
    const mainNav = document.getElementById( 'main-nav' );

    btnOpenMainNav.addEventListener( 'click', () => {
        mainToggle.classList.toggle( 'toggle-opened' );
        console.log( 'open main' );
        mainNav.style.top = 0;
        mainNav.style.zIndex = 10;
    });

    /**
     * Fermeture main nav
     */
    const btnCloseMainNav = document.getElementById( 'btn-close-main-nav' );

    btnCloseMainNav.addEventListener( 'click', () => {
        mainToggle.classList.toggle( 'toggle-opened' );
        console.log( 'close main' );
        mainNav.style.top = '100%';
        mainNav.style.zIndex = 'auto';
    });

    /**
     * Open sub nav
     */
    const secondToggle = document.getElementById( 'secondToggle' );//pour faire suivant infographiste mais marche pas
    let notAdd = false;

    secondToggle.addEventListener( 'click', () => {
        if ( false === notAdd ) {
            console.log( 'ici' );
            secondToggle.classList.toggle( 'toggle-opened' );

            //  secondToggle.classList.add( 'd-flex' );
            notAdd = true;
        }
    });

    /**
     * Fermeture sub nav
     */
    const btnCloseSubNav = document.querySelector( '.btn-close-sub-nav' );
    const popo = document.getElementById( 'popo' );

    if ( null !== btnCloseSubNav ) {
        btnCloseSubNav.addEventListener( 'click', () => {
            secondToggle.classList.toggle( 'toggle-opened' );
            console.log( 'second' );
            notAdd = true;

            //     popo.classList.add( 'd-none' );
            console.log( 'la' );

        //    secondToggle.classList.remove( 'd-flex' );
        });
    }
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
