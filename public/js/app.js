/*Enregistrement service worker*/
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js', { scope: '../' }).then(function(reg) {
        // enregistrement ok
        console.log('Registration succeeded. Scope is ' + reg.scope);
    }).catch(function(error) {
        // echec de l'enregistrement
        console.log('Registration failed with ' + error);
    });

}

let deferredPrompt;
const addBtn = document.querySelector('.pwa-download');

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Update UI to notify the user they can add to home screen
    addBtn.style.display = 'block';

    addBtn.addEventListener('click', (e) => {
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the A2HS prompt');
            } else {
                console.log('User dismissed the A2HS prompt');
            }
            deferredPrompt = null;
        });
    });
})

/*Notifications simples*/

var button = document.getElementById("notifications");
button.addEventListener('click', function(e) {
    Notification.requestPermission().then(function(result) {
        if(result === 'granted') {
            randomNotification();
        }
    });
});

function randomNotification() {
    var randomNumber = getRandomInt(5);
    console.log(randomNumber);
    if(randomNumber >= 2) {

        var notifTitle = "Chaud, non ?";
        var notifBody = 'Température : ' + randomNumber + '.';
        var notifImg = '/public/assets/favicon/android-chrome-192x192.png';
        var options = {
            body: notifBody,
            icon: notifImg
        }
        var notif = new Notification(notifTitle, options);

    }
    setTimeout(randomNotification, 30000);
}
