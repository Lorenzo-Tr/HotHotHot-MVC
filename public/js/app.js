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


