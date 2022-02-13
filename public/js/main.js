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

  loadHomeData();
})

window.addEventListener("load", () => {
  loadHomeData();

  if (DOM.OUTPUT_DATE != null)
    Utils.getStringDate(DOM.OUTPUT_DATE);


  if (DOM.EXTERIOR_MINI_CARD != null) {
    Utils.setTemp(DOM.EXTERIOR_MINI_CARD, "exterior");
    // makeChart(DOM.CANVAS_EXTERIOR);
  }
  if (DOM.INTERIOR_MINI_CARD != null) {
    Utils.setTemp(DOM.INTERIOR_MINI_CARD, "interior");
    // makeChart(DOM.CANVAS_INTERIOR);
  }
  if (DOM.TEMPLATE_INTERIOR != null) {
    fetch("/caching/get_interior_history")
        .then(r => r.json())
        .then(json => {
          Utils.showHistory(DOM.TEMPLATE_INTERIOR, DOM.HISTORY, json)
        })
  }
  if (DOM.TEMPLATE_EXTERIOR != null) {
    fetch("/caching/get_exterior_history")
        .then(r => r.json())
        .then(json => {
          Utils.showHistory(DOM.TEMPLATE_EXTERIOR, DOM.HISTORY, json)
        })
    // let data = [
    //   { '14:00': "20" },
    //   { '13:00': "22" },
    //   { '12:00': "20" },
    //   { '11:00': "15" },
    //   { '10:00': "12" },
    //   { '09:00': "9" },
    // ]
    // Utils.showHistory(DOM.TEMPLATE_EXTERIOR, DOM.HISTORY, data)
  }
})

if (DOM.FETCH_NEW_DATA != null) {
  DOM.FETCH_NEW_DATA.addEventListener('click', () => {
    localStorage.clear()
    window.location = ''
  });
}

function loadHomeData() {
  fetch("/caching/get_home")
      .then(r => r.json())
      .then(json => {
        localStorage.setItem('EXTERIOR_TEMP', json.exterieur.value)
        localStorage.setItem('EXTERIOR_MAX', json.exterieur.max)
        localStorage.setItem('EXTERIOR_MIN', json.exterieur.min)

        localStorage.setItem('INTERIOR_TEMP', json.interieur.value)
        localStorage.setItem('INTERIOR_MAX', json.interieur.max)
        localStorage.setItem('INTERIOR_MIN', json.interieur.min)
      })

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


