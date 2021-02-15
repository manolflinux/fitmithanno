//Programmierter Timer
window.addEventListener("load", function () {
  document.querySelectorAll("div.timer").forEach(function (t) {
    // create elements //
    var text = document.createElement("p");
    var inpt = document.createElement("input");
    var bttn = document.createElement("button");
    // add elements //
    t.appendChild(text);
    t.appendChild(inpt);
    t.appendChild(bttn);
    // attributes //
    inpt.setAttribute("type", "time");
    inpt.setAttribute("value", "00:00");
    bttn.innerHTML = "STARTEN";
    // style //
    text.style.width = "100%";
    text.style.marginBottom = "6%";
    text.style.fontSize = "200%";
    text.style.fontFamily = "Arial";
    text.style.textAlign = "center";
    inpt.style.width = "50%";
    bttn.style.width = "50%";
    // init timer //
    new Timer(t, text, inpt, bttn);
  });
});

function Timer(div, txt, inp, btn) {
  var that = this;

  this.nodes = new Array();

  this.nodes["container"] = div;
  this.nodes["output"] = txt;
  this.nodes["input"] = inp;
  this.nodes["button"] = btn;

  this.value = 0;
  this.fps = 60;

  this.nodes["output"].innerHTML = this.getFormattedValue();

  this.nodes["input"].addEventListener(
    "input",
    function () {
      that.setValue(that.nodes["input"].value);
    },
    false
  );

  this.nodes["button"].addEventListener(
    "click",
    function () {
      that.start();
    },
    false
  );
}

Timer.prototype.start = function () {
  var that = this;
  this.timerID = setInterval(function () {
    that.value -= 1000 / that.fps;
    if (that.value <= 0) {
      clearInterval(that.timerID);
      that.onExpire();
      that.value = 0;
    }
    that.update();
  }, 1000 / this.fps);
};

Timer.prototype.update = function () {
  this.nodes["output"].innerHTML = this.getFormattedValue();
};

Timer.prototype.onExpire = function () {
  var that = this;
  for (var i = 0; i < 10; i++) {
    setTimeout(function () {
      that.nodes["container"].style.backgroundColor = "#187c29";
    }, i * 200);
    setTimeout(function () {
      that.nodes["container"].style.backgroundColor = "inherit";
    }, i * 200 + 100);
  }
};

Timer.prototype.getFormattedValue = function () {
  return (
    this.f(this.getHour()) +
    ":" +
    this.f(this.getMins()) +
    ":" +
    this.f(this.getSecs()) +
    ":" +
    this.f(this.getMSec())
  );
};

Timer.prototype.f = function (
  v // returns the value with 2 decimals
) {
  if (v.toString().length < 2) return "0" + v;
  if (v.toString().length > 2) return v.toString().substring(0, 2);
  return v;
};

Timer.prototype.setValue = function (v) {
  this.value = v.split(":", 2)[0] * 60 * 1000;
  this.value += v.split(":", 2)[1] * 1000;
  this.update();
};

Timer.prototype.getHour = function () {
  return Math.floor(Math.floor(this.value / 60 / 60 / 1000) % 1);
};
Timer.prototype.getMins = function () {
  return Math.floor(Math.floor(this.value / 60 / 1000) % 60);
};
Timer.prototype.getSecs = function () {
  return Math.floor(Math.floor(this.value / 1000) % 60);
};
Timer.prototype.getMSec = function () {
  return Math.floor(Math.floor(this.value) % 1000);
};

//TIMER 1

let vergangenezeit = 1;
// let sekundenzaehler = setInterval(sekundenanzeige, 1000);

function sekundenanzeige() {
  //document.write(vergangenezeit + "<br>");
  timer1.innerHTML = vergangenezeit;
  vergangenezeit++;
}

// anonyme function
// let vergangenezeit = 1;
// setInterval(
// function() {
// 	document.write(vergangenezeit + "<br>");
// 	vergangenezeit++;
// }
//   	, 1000
//    );

//TIMER2
seconds = 1;
function sekundenanzeige2() {
  //document.write(vergangenezeit + "<br>");
  timer2.innerHTML = seconds;
  seconds++;
}

function resetTimer(seconds) {
  seconds = 0; //damit es wieder bei 0 startet
  timer2.innerHTML = seconds; //damit es auch 0 anzeigt
}

//TIMER3
seconds3 = 1;
function sekundenanzeige3() {
  //document.write(vergangenezeit + "<br>");
  timer3.innerHTML = seconds3;
  seconds3++;

  if (seconds3 > 10) {
    clearInterval(twentySeconds);
  }
}

//Uhrzeit

function uhrzeitausgabe() {
  let zeitpunkt = new Date();
  let uhrzeit = zeitpunkt.toLocaleTimeString();
  //   document.write(uhrzeit + "<br>");
  clock.innerHTML = uhrzeit;
}

//COUNTDOWN
seconds4 = 20;
function countdown20() {
  //document.write(vergangenezeit + "<br>");
  timerCountdown.innerHTML = seconds4;
  seconds4--;

  if (seconds4 < 0) {
    clearInterval(countdown);
    timerCountdown.innerHTML = "TIME OVER";
  }
}

//Timer Tabata
secondsBeginning = 5;
secondsAction = 20;
secondsRest = 10;
next = 0;

// function beginning() {
//   //document.write(vergangenezeit + "<br>");
//   clockTabata.innerHTML = secondsBeginning;
//   secondsBeginning--;

//   if (secondsBeginning < 0) {
//     clearInterval(countDownTabata);
//     clockTabata.innerHTML = "ACTION";
//   }
// }

//small
function beginning() {
  clockBegin.innerHTML = secondsBeginning;
  secondsBeginning--;

  if (secondsBeginning < 0) {
    clearInterval(countDownStart);
    clockBegin.innerHTML = "ACTION";
  }
}

function action() {
  clockAction.innerHTML = secondsAction;
  secondsAction--;

  if (secondsAction < 0) {
    clearInterval(countDownAction);
    // resetTimer(countdownTabata);
    clockAction.innerHTML = "REST";
  }
}

function rest() {
  clockRest.innerHTML = secondsRest;
  secondsRest--;

  if (secondsRest < 0) {
    clearInterval(countDownRest);
    // resetTimer(countdownTabata);
    clockRest.innerHTML = "ACTION";
  }
}

// THINKING BIG

function beginningTabata() {
  screenTabata.innerHTML = "Start in Seconds: ";
  clockTabata.innerHTML = secondsBeginning;
  secondsBeginning--;

  // if (secondsBeginning == -1) {
  //   clockTabata.innerHTML = "HIER";
  // }

  if (secondsBeginning < 0) {
    clearInterval(countDownStart);
    count++;
    round++;
    screenTabata.innerHTML = "ROUND " + count + ": ACTION";
    clockTabata.innerHTML = "";
    // countDownStart.onExpire();
    // countDownStart.value = 0;

    timerTabata();
  }
}

function actionTabata() {
  clockTabata.innerHTML = secondsAction;
  secondsAction--;

  if (secondsAction < 0) {
    clearInterval(countDownAction);
    // resetTimer(countdownTabata);
    count++;
    screenTabata.innerHTML = "ROUND " + round + ": REST";
    clockTabata.innerHTML = "";
    // countDownAction.onExpire();
    // countDownAction.value = 0;
    secondsAction = 20;

    timerTabata();
  }
}

function restTabata() {
  clockTabata.innerHTML = secondsRest;
  secondsRest--;

  if (secondsRest < 0) {
    clearInterval(countDownRest);
    // resetTimer(countdownTabata);
    count++;
    round++;
    screenTabata.innerHTML = "ROUND " + round + ": ACTION";
    clockTabata.innerHTML = "";
    // countDownRest.onExpire();
    // countDownRest = 0;
    secondsRest = 10;

    timerTabata();
  }
}

let count = 0;
let round = 0;
// countRound = ["countRound1", "countRound2", "countRound3"];
function timerTabata() {
  // beginning();

  if (count == 0) {
    countDownStart = setInterval(beginningTabata, 1000);
  }

  if (
    count == 1 ||
    count == 3 ||
    count == 5 ||
    count == 7 ||
    count == 9 ||
    count == 11 ||
    count == 13 ||
    count == 15
  ) {
    countDownAction = setInterval(actionTabata, 1000);
  }

  if (
    count == 2 ||
    count == 4 ||
    count == 6 ||
    count == 8 ||
    count == 10 ||
    count == 12 ||
    count == 14 ||
    count == 16
  ) {
    countDownRest = setInterval(restTabata, 1000);
  }

  // if (count == 3) || (count == 4) || (count == 6) || (count == 8) || (count == 10) || (count == 12) {
  //   countDownAction = setInterval(actionTabata, 1000);
  // }

  // if (count == 1) {
  //   countDownStart = setInterval(beginningTabata, 1000);
  // }

  // if (count == 2) {
  //   countDownAction = setInterval(actionTabata, 1000);
  // }

  // if (count == 3) {
  //   countDownRest = setInterval(restTabata, 1000);
  // }

  // if (count == 4) {
  //   countDownAction = setInterval(actionTabata, 1000);
  // }

  // if (count == 5) {
  //   countDownAction = setInterval(actionTabata, 1000);
  // }

  // if (count == 6) {
  //   countDownRest = setInterval(restTabata, 1000);
  // }

  // if (count == 7) {
  //   countDownAction = setInterval(actionTabata, 1000);
  // }

  // if (count == 8) {
  //   countDownRest = setInterval(restTabata, 1000);
  // }

  if (count == 17) {
    screenTabata.innerHTML = "TRAINING DONE! ";
  }

  // setInterval(action, 1000);

  //setInterval(timerTabata, 1000);
  // action();

  // switch (next) {
  //   case 0:
  //     console.log("case 0: " + next);
  //     next++;
  //     console.log("mod: " + (next % 2));
  //     mod = next % 2;
  //     //beginning();
  //     timerTabata(mod);
  //     break;

  //   case 1:
  //     console.log("case 1: " + next);
  //     next++;
  //     mod = next % 2;
  //     // action();
  //     timerTabata(mod);
  //     break;

  //   case 2:
  //     console.log("case 2: " + next);
  //     next++;
  //     //rest();
  //     break;

  //   case 5:
  //     console.log("case 5");
  //     console.log("over");
  //     break;

  //   default:
  //     console.log("case default");
  //     next++;
  //   //clockTabata.innerHTML = "OVER";
  // }
}

function resetTabataTimer() {
  count = 0;
  round = 0;
  secondsBeginning = 5;
  secondsAction = 20;
  secondsRest = 10;

  screenTabata.innerHTML = "Push START";
  clockTabata.innerHTML = "";
}

function stopTabataTimer() {
  clearInterval(countDownStart);
  clearInterval(countDownAction);
  clearInterval(countDownRest);
}
