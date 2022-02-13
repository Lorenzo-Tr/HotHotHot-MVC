import * as Utils from './modules/utils.js';
import * as DOM from './modules/const.js';
// import { makeChart } from './modules/chart.js';
import * as Alert from './modules/alert.js';

const socket = new WebSocket('wss://ws.hothothot.dog:9502');

setTimeout(function(){
  Utils.webSocketConnect(socket).then(function(socket) {
    console.log("[open] Connection established");
    socket.send("Connection");
  }).catch(function(err) {
    console.log(`[error] ${err.message}`);
  });
}, 2000)

Utils.getWebSocketData(socket, (data) => {
  let formData = new FormData();
  formData.append('data', JSON.stringify(data));

  let fetchData = {
    method: 'POST',
    body: formData,
    headers: new Headers()
  }

  fetch('/caching/save', fetchData)
      .catch(err => console.log(err))

  updateUi(data)
})

function updateUi(data){
  console.log(data)
  localStorage.setItem('INTERIOR_TEMP', data.capteurs[0].Valeur)
  localStorage.setItem('EXTERIOR_TEMP', data.capteurs[1].Valeur)
  loadHomeData();
}

window.addEventListener("load", () => {
  if (localStorage.length == 0) {
    let minInt = null;
    let maxInt = null;
    let minExt = null;
    let maxExt = null;
    //Utils.getTempJSON("/public/assets/data/temp.json", r => {
    //  let data = Utils.getRandomData(r);
//
    //  localStorage.setItem('EXTERIOR_TEMP', data.exterior.temp)
    //  localStorage.setItem('EXTERIOR_MAX', data.exterior.max)
    //  localStorage.setItem('EXTERIOR_MIN', data.exterior.min)
//
    //  localStorage.setItem('INTERIOR_TEMP', data.interior.temp)
    //  localStorage.setItem('INTERIOR_MAX', data.interior.max)
    //  localStorage.setItem('INTERIOR_MIN', data.interior.min)
//
    //  loadHomeData();
    //});


    // Listen for messages
    socket.addEventListener('message', function (event) {
    let data = JSON.parse(event.data)
    console.log('Message from server ', data.capteurs[0].Valeur);
    

    localStorage.setItem('INTERIOR_TEMP', data.capteurs[0].Valeur)
    if (!minInt){
      minInt = data.capteurs[0].Valeur
      localStorage.setItem('INTERIOR_MIN', minInt)
    }else if (minInt>data.capteurs[0].Valeur){
      minInt = data.capteurs[0].Valeur
      localStorage.setItem('INTERIOR_MIN', minInt)
    }

    if (!maxInt){
      maxInt = data.capteurs[0].Valeur
      localStorage.setItem('INTERIOR_MAX', maxInt)
    }else if (maxInt<data.capteurs[0].Valeur){
      maxInt = data.capteurs[0].Valeur
      localStorage.setItem('INTERIOR_MAX', maxInt)
    }


    localStorage.setItem('EXTERIOR_TEMP', data.capteurs[1].Valeur)
    if (!minExt){
      minExt = data.capteurs[1].Valeur
      localStorage.setItem('EXTERIOR_MIN', minExt)
    }else if (minExt>data.capteurs[1].Valeur){
      minExt = data.capteurs[1].Valeur
      localStorage.setItem('EXTERIOR_MIN', minExt)
    }

    if (!maxExt){
      maxExt = data.capteurs[1].Valeur
      localStorage.setItem('EXTERIOR_MAX', maxExt)
    }else if (maxExt<data.capteurs[1].Valeur){
      maxExt = data.capteurs[1].Valeur
      localStorage.setItem('EXTERIOR_MAX', maxExt)
    }
    

    });
    
  }

  if (DOM.OUTPUT_DATE != null)
    Utils.getStringDate(DOM.OUTPUT_DATE);

  loadHomeData();

  if (DOM.EXTERIOR_MINI_CARD != null) {
    Utils.setTemp(DOM.EXTERIOR_MINI_CARD, "exterior");
    makeChart(DOM.CANVAS_EXTERIOR);
  }
  if (DOM.INTERIOR_MINI_CARD != null) {
    Utils.setTemp(DOM.INTERIOR_MINI_CARD, "interior");
    makeChart(DOM.CANVAS_INTERIOR);
  }
  if (DOM.TEMPLATE_INTERIOR != null) {
    let data = [
      { '14:00': "20" },
      { '13:00': "22" },
      { '12:00': "20" },
      { '11:00': "15" },
      { '10:00': "12" },
      { '09:00': "9" },
    ]
    Utils.showHistory(DOM.TEMPLATE_INTERIOR, DOM.HISTORY, data)
  }
  if (DOM.TEMPLATE_EXTERIOR != null) {
    let data = [
      { '14:00': "20" },
      { '13:00': "22" },
      { '12:00': "20" },
      { '11:00': "15" },
      { '10:00': "12" },
      { '09:00': "9" },
    ]
    Utils.showHistory(DOM.TEMPLATE_EXTERIOR, DOM.HISTORY, data)
  }
})

if (DOM.FETCH_NEW_DATA != null) {
  DOM.FETCH_NEW_DATA.addEventListener('click', () => {
    localStorage.clear()
    window.location = ''
  });
}

function loadHomeData() {
  if (DOM.NODE_EXTERIOR_TEMP != null || DOM.NODE_INTERIOR_TEMP != null || DOM.TEMPLATE_WARNING != null) {
    let node = {
      "exterior": DOM.NODE_EXTERIOR_TEMP,
      "interior": DOM.NODE_INTERIOR_TEMP
    }
    Utils.setTemp(node);

    Alert.appendWarning(DOM.LASTALERT_LIST).then(() => {
      if (DOM.LASTALERT_LIST.childElementCount != 0) {
        DOM.ALERT_PLACEHOLDER.classList.add("hidden");
      }else {
        DOM.ALERT_PLACEHOLDER.classList.remove("hidden");
      }
    })
  }
}


