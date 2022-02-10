import { Gradient } from './Gradient.js'


// Create your instance
const gradient = new Gradient()

// Call `initGradient` with the selector to your canvas
gradient.initGradient('#gradient-canvas')

let socket = new WebSocket("wss://ws.hothothot.dog:9502");

setTimeout(function(){if (socket.readyState === 1){
    console.log("Connexion établie");
    socket.onmessage = function(event) {
        console.log("receivedata")
        let data = JSON.parse(event.data);
        console.log(data)
    };
}else{
    console.log("état socket.readyState");
    console.log(socket.readyState);
};}, 5000)


socket.onopen = function (event) {
    console.log("CONNEXION FAITE");
};