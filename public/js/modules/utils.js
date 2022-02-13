// Get a formated Date
export function getStringDate(output) {
  const objDate = new Date();
  let dayOfWeek = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(objDate);
  let monthOfYears = new Intl.DateTimeFormat('en-US', { month: 'short' }).format(objDate);
  return (output).innerHTML = dayOfWeek + ', ' + objDate.getDate() + ' ' + monthOfYears;
}

// Fetch values from a JSON file
export async function getTempJSON(path, callback) {
  return callback(await fetch(path).then(r => r.json()));
}

// Set the values of a temp card
export function setTemp(node, option = "all") {
  if (option === "all") {
    node.exteriorData = node.exterior.querySelectorAll("data")
    node.interiorData = node.interior.querySelectorAll("data")
  } else {
    node = {
      "interior": node,
      "exterior": node,
      "interiorData": node.querySelectorAll("data"),
      "exteriorData": node.querySelectorAll("data"),
    }
  }

  let exteriorColor = mixColor([252, 37, 37],[37, 117, 252], getPercentage(localStorage.getItem('EXTERIOR_TEMP'))/100)

  let interiorColor = mixColor([252,37,37], [37,117,252], getPercentage(localStorage.getItem('EXTERIOR_TEMP'))/100)

  if (option === "all" || option === "exterior") {
    var domExteriorTemp = node.exteriorData[0];
    var domExteriorMaxTemp = node.exteriorData[1];
    var domExteriorMinTemp = node.exteriorData[2];

    domExteriorTemp.setAttribute("value", `${localStorage.getItem('EXTERIOR_TEMP')}`);
    domExteriorMaxTemp.setAttribute("value", `${localStorage.getItem('EXTERIOR_MAX')}`);
    domExteriorMinTemp.setAttribute("value", `${localStorage.getItem('EXTERIOR_MIN')}`);

    node.exterior.setAttribute("style", `background-image: radial-gradient(at top right, rgb(${exteriorColor}), transparent),radial-gradient(at bottom left, #6A11CB, transparent),radial-gradient(at bottom right, #7AA8F5, transparent),radial-gradient(at top left, #B581ED, transparent);`);
  }

  if (option === "all" || option === "interior") {
    var domInteriorTemp = node.interiorData[0];
    var domInteriorMaxTemp = node.interiorData[1];
    var domInteriorMinTemp = node.interiorData[2];

    domInteriorTemp.setAttribute("value", `${localStorage.getItem('INTERIOR_TEMP')}`);
    domInteriorMaxTemp.setAttribute("value", `${localStorage.getItem('INTERIOR_MAX')}`);
    domInteriorMinTemp.setAttribute("value", `${localStorage.getItem('INTERIOR_MIN')}`);

    node.interior.setAttribute("style", `background-image: radial-gradient(at top right, rgb(${interiorColor}), transparent),radial-gradient(at bottom left, #6A11CB, transparent),radial-gradient(at bottom right, #7AA8F5, transparent),radial-gradient(at top left, #B581ED, transparent);`);
  }
}

// Show History
export function showHistory(DOM, parent, data) {
  data.forEach(element => {
    let clone = DOM.cloneNode(true);
    let hours = clone.content.querySelector(".hours");
    let temp = clone.content.querySelector(".historyTemp");
    hours.setAttribute('value', Object.keys(element))
    temp.setAttribute('value', Object.values(element))
    parent.appendChild(clone.content);
  });
  
}

// Get a mixed color with a percertange
export function mixColor(color1, color2, weight) {
  var w1 = weight;
  var w2 = 1 - w1;
  var rgb = [Math.round(color1[0] * w1 + color2[0] * w2),
      Math.round(color1[1] * w1 + color2[1] * w2),
      Math.round(color1[2] * w1 + color2[2] * w2)];
  return rgb;
}

// Get random index
export function getRandomData(data) {
  var size = 0,
  key;
  for (key in data) {
    if (data.hasOwnProperty(key)) size++;
  }
  let i = Math.floor(Math.random() * size);
  return data[i];
}

// Get percentage of input value between config min and max
export function getPercentage(input) {
  const RANGE_MIN = 10;
  const RANGE_MAX = 30;

  var percentage = ((input - RANGE_MIN) * 100) / (RANGE_MAX - RANGE_MIN);

  if (percentage > 100) {
    percentage = 100;
  } else if (percentage < 0){
    percentage = 0;
  }

  return percentage;
}

export function webSocketConnect(socket) {
  console.log('Trying to connect...');
  return new Promise(function(resolve, reject) {
    socket.onopen = () => {
      resolve(socket);
    }

    socket.onerror = (err) => {
      reject(err);
    }
  });
}

export function getWebSocketData(socket, callback) {
  socket.addEventListener('message', function (e) {
    console.log("receive")
    let data = JSON.parse(e.data);
    callback(data);
  });
}


  // socket.onmessage = function(event) {
  //
  //
  //     callback
  //
  //
  //     console.log(data)
  //     console.log(data.capteurs)
  //     console.log(data.capteurs[0])
  //     console.log(data.capteurs[0].Nom)
  //
  //
  // };

  // socket.onclose = function(event) {
  //     if (event.wasClean) {
  //         alert(`[close] Connection closed cleanly, code=${event.code} reason=${event.reason}`);
  //     } else {
  //       // par exemple : processus serveur arrêté ou réseau en panne
  //       // event.code est généralement 1006 dans ce cas
  //         alert('[close] Connection died');
  //     }
  // };