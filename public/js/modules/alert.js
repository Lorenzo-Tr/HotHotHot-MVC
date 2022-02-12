export async function appendWarning(parent) {
  if (localStorage.getItem('EXTERIOR_TEMP') > 35) {
    let Warning = new alert('warning', "🥵 HotHotHot ! The temperature is really high ");
    Warning.appendAlert(parent)
  }
  if (localStorage.getItem('EXTERIOR_TEMP') < 0) {
    let Warning = new alert('warning', "🥶 Very low temperature! Cover yourself with 5 layers of clothing before going out");
    Warning.appendAlert(parent)
  }
  if (localStorage.getItem('INTERIOR_TEMP') > 20 && localStorage.getItem('INTERIOR_TEMP') < 25) {
    let Information = new alert('info', "You should probably turn on your fan or air conditioning 😉");
    Information.appendAlert(parent)
  }
  if (localStorage.getItem('INTERIOR_TEMP') > 28 ) {
    let Warning = new alert('warning', "To survive go inside your refrigerator 🧊");
    Warning.appendAlert(parent)
  }
  if (localStorage.getItem('INTERIOR_TEMP') > 11 && localStorage.getItem('INTERIOR_TEMP') < 18) {
    let Information = new alert('info', "You should probably turn on your heater 😉");
    Information.appendAlert(parent)
  }
  if (localStorage.getItem('INTERIOR_TEMP') < 11  && localStorage.getItem('INTERIOR_TEMP') > 0) {
    let Warning = new alert('warning', "To survive, roll yourself in any fabric you can find 🛏");
    Warning.appendAlert(parent)
  }
}

class alert {
  template = document.querySelector('#templateAlert')
  type = "waring";
  title = "Alert";
  content = "Default alert content";
  imgsrc = document.querySelector('img');

  constructor(type, content) {
    this.type = type;
    this.content = content;
    this.selectCorrectImg(this.type);
    this.titleGenerator(this.type);
  }

  getFormatedDate () {
    const objDate = new Date();
    let dayOfWeek = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(objDate);
    let monthOfYears = new Intl.DateTimeFormat('en-US', { month: 'short' }).format(objDate);
    return dayOfWeek + ', ' + objDate.getDate() + ' ' + monthOfYears;
  }

  selectCorrectImg(type) {
    if (type === "info") {
      this.imgsrc = "/public/assets/img/Info.webp";
    }
    if (type === "warning") {      
      this.imgsrc = "/public/assets/img/Warning.webp";
    }
  }

  titleGenerator(type) {
    if (type === "info") {
      this.title = 'Information - ' + this.getFormatedDate()
    }
    if (type === "warning") {
      this.title = 'Warning - ' + this.getFormatedDate()
    }
  }

  appendAlert(parent) {
    let alert = this.template.cloneNode(true).content;
    alert.querySelector('h4').textContent = this.title;
    alert.querySelector('p').textContent = this.content;
    alert.querySelector('img').setAttribute('src', this.imgsrc);
    parent.appendChild(alert);
  }
}