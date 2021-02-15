// THINKING BIG

function beginningTabata() {
  screenTabata.innerHTML = "Start in Seconds: ";
  clockTabata.innerHTML = secondsBeginning;
  secondsBeginning--;


  if (secondsBeginning < 0) {
    clearInterval(countDownStart);
    count++;
    round++;
    screenTabata.innerHTML = "ROUND " + count + ": ACTION";
    clockTabata.innerHTML = "";

    timerTabata();
  }
}

function actionTabata() {
  clockTabata.innerHTML = secondsAction;
  secondsAction--;

  if (secondsAction < 0) {
    clearInterval(countDownAction);
    count++;
    screenTabata.innerHTML = "ROUND " + round + ": REST";
    clockTabata.innerHTML = "";
    secondsAction = 20;

    timerTabata();
  }
}

function restTabata() {
  clockTabata.innerHTML = secondsRest;
  secondsRest--;

  if (secondsRest < 0) {
    clearInterval(countDownRest);
    count++;
    round++;
    screenTabata.innerHTML = "ROUND " + round + ": ACTION";
    clockTabata.innerHTML = "";
    secondsRest = 10;

    timerTabata();
  }
}

//start setting
let count = 0;
let round = 0;
let mod = 0;
let max = 17;

//setting for last round
// let count = 14;
// let round = 7;


function timerTabata() {

  if (count == 0) {
    countDownStart = setInterval(beginningTabata, 1000);
  }

  if (count % 2 != 0) {
    countDownAction = setInterval(actionTabata, 1000);
    console.log("count%2 != 0 :) " + count);
  }

  if (count != 0 && count % 2 == 0) {
    countDownRest = setInterval(restTabata, 1000);
    console.log("(count != 0) && (count % 2 == 0) " + count);
  }

  if (count == max) {
    screenTabata.innerHTML = "TRAINING DONE! ";
    //stopTabataTimer();
    clearInterval(countDownRest);
    clearInterval(countDownAction);
    count = 0;
    round = 0;
  }
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

//check order: important!!
function stopTabataTimer() {
  clearInterval(countDownStart);
  clearInterval(countDownAction);
  clearInterval(countDownRest);
}