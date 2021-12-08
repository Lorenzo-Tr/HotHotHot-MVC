// function to set a given theme/color-scheme
function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
}
// function to toggle between light and dark theme
function toggleTheme() {
    if (localStorage.getItem('theme') === 'theme-dark') {
        setTheme('theme-light');
    } else {
        setTheme('theme-dark');
    }
}
// Immediately invoked function to set the theme on initial load
(function () {
    if (localStorage.getItem('theme') === 'theme-dark') {
        setTheme('theme-dark');
    } else {
        setTheme('theme-light');
    }
})();

var keys = {};
/*
 * Mise du code appelé en commun dans une
 * fonction que nous allons
 * abonnée à un écouteur d'évènement.
 */
function trackMultipleKeyStroke(e) {
    e = e || event;
    e.which = e.which || e.keyCode;
    keys[e.which] = e.type === 'keydown';
    /*
     * Cette partie constitue le code exécuté quand
     * Ctrl (17), Shift (16) et L (76)
     * sont enfoncées.
     */
    if (keys[17] && keys[16] && keys[76]) {
        console.log('Ctrl + Shift + L');
        toggleTheme()
    }
}
/*
 * Fonction de rétro-compatibilité pour
 * les navigateurs Internet Explorer.
 * Elle marchera dans tous les navigateurs
 * et demandera qui s'abonne, à quel évènement
 * et ce qu'il se passe quand l'évènement est
 * appelé / levé.
 */
function addEvent(element, event, func) {
    /*
     * Avons nous à faire à un vieil Internet Explorer ?
     */
    if (element.attachEvent) {
        /*
         * Abonnons nous alors comme Internet Explorer le propose.
         */
        return element.attachEvent('on' + event, func);
    } else {
        /*
         * Nous nous abonnons comme la spécification ECMAScript le propose.
         */
        return element.addEventListener(event, func, false);
    }
}


addEvent(window, "keydown", trackMultipleKeyStroke);
addEvent(window, "keyup", trackMultipleKeyStroke);