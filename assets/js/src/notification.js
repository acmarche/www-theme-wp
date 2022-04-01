// Import the functions you need from the SDKs you need
import { initializeApp } from 'firebase/app';
import { getAnalytics } from 'firebase/analytics';
import { getMessaging, getToken, onMessage } from 'firebase/messaging';
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: 'AIzaSyAWLMT0P9-Nu7ECNx6EYuFiFJax_mP21bk',
    authDomain: 'notifications-bf2c8.firebaseapp.com',
    projectId: 'notifications-bf2c8',
    storageBucket: 'notifications-bf2c8.appspot.com',
    messagingSenderId: '571583228471',
    appId: '1:571583228471:web:3e76dbf7f287a0d19aedb2',
    measurementId: 'G-YD6MK7CGVH'
};

const apiKeyPublic = 'BEhaaqfwyOQ9bYIwzikK3SCI_tJYzf_fle9idtkWuoYgtkNF0lj0-6vNpbp82RKuJLxWzTmHm10y4NXAnkkRMSs';
// Initialize Firebase
const app = initializeApp( firebaseConfig );
const analytics = getAnalytics( app );
// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
const messaging = getMessaging();
getToken( messaging, { vapidKey: apiKeyPublic } )
    .then( ( currentToken ) => {
        if (currentToken) {
      console.log("Firebase Token", currentToken);
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
messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
   // icon: '/firebase-logo.png'
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});