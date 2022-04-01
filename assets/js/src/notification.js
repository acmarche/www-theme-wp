// https://firebase.google.com/docs/cloud-messaging/js/receive?authuser=0
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken, onMessage } from 'firebase/messaging';
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyA9LbyQzJrRkWsRvUJyf3dyWe0mPRWxN7s",
    authDomain: "marchebe-af3e0.firebaseapp.com",
    databaseURL: "https://marchebe-af3e0.firebaseio.com",
    projectId: "marchebe-af3e0",
    storageBucket: "marchebe-af3e0.appspot.com",
    messagingSenderId: "510808639785",
    appId: "1:510808639785:web:bb141aab46486792ebcf38",
    measurementId: "G-J1K585BK2W"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
//const analytics = getAnalytics(app);
const messaging = getMessaging();
const apiKeyPublic = 'BM0PSKoJBRwKjoRWaA5aLTj5tGfxhk7XtAWwcsqygqUNfn-MakAVHcE0REQfMcGFAGz9fGAkOwV3jKuJex8XkbM';

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
getToken( messaging, { vapidKey: apiKeyPublic } )
    .then( ( currentToken ) => {
        if (currentToken) {
            console.log( 'Firebase Token', currentToken );
            console.log( 'Send the token to your server and update the UI if necessary' );
            // ...
        } else {
            // Show permission request UI
            console.log( 'No registration token available. Request permission to generate one.' );
            // ...
        }
    } )
    .catch( ( err ) => {
        console.log( 'An error occurred while retrieving token. ', err );
        // ...
    } );
onMessage( messaging, ( payload ) => {
    console.log( 'Message received. ', payload );
    // ...
} );
// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// Keep in mind that FCM will still show notification messages automatically
// and you should use data messages for custom notifications.
// For more info see:
// https://firebase.google.com/docs/cloud-messaging/concept-options
onMessage( messaging, function( payload ) {
    console.log( '[firebase-messaging-sw.js] Received background message ', payload );
    // Customize notification here
    const notificationTitle = 'Background Message Title22';
    const notificationOptions = {
        body: 'Background Message body.22',
        icon: 'https://www.marche.be/wp-content/themes/marchebe/assets/tartine/rsc/img/img_logo.png'
    };

    self.registration.showNotification( notificationTitle,
        notificationOptions );
} );

/**
 * message.notification.title
 message.notification.body
 message.data
 */