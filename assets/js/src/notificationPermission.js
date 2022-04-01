//https://developer.mozilla.org/fr/docs/Web/API/Notifications_API/Using_the_Notifications_API
function askNotificationPermission() {
    // La fonction qui sert effectivement à demander la permission
    function handlePermission( permission ) {
        // On affiche ou non le bouton en fonction de la réponse
        if (Notification.permission === 'denied' || Notification.permission === 'default') {
            notificationBtn.style.display = 'block';
        } else {
            notificationBtn.style.display = 'none';
        }
    }

    // Vérifions si le navigateur prend en charge les notifications
    if (! ( 'Notification' in window )) {
        console.log( 'Ce navigateur ne prend pas en charge les notifications.' );
    } else {
        if (checkNotificationPromise()) {
            Notification.requestPermission()
                .then( ( permission ) => {
                    handlePermission( permission );
                } );
        } else {
            Notification.requestPermission( function( permission ) {
                handlePermission( permission );
            } );
        }
    }
}

function checkNotificationPromise() {
    try {
      Notification.requestPermission().then();
    } catch(e) {
      return false;
    }

    return true;
  }

function createNotif(titre) {
    const img = '/to-do-notifications/img/icon-128.png';
    const text = 'Coucou ! Votre tâche "' + titre + '" arrive maintenant à échéance.';
    const notification = new Notification( 'Liste de trucs à faire', {
        body: text,
       // icon: img
    } );
}

const notificationBtn = document.getElementById( 'notificationBtn' );
notificationBtn.addEventListener( 'click', () => {
    createNotif("Lolo");
});