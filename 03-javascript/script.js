var shapeStyle = document.getElementById("shape").style;
var timeDisplay = document.getElementById("timeDisplay");
var startTime;
var gameStarted = false;

function getRandomBoolean() {
    var random = Math.random();
    return random >= 0.5;
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function newShape() {
    startTime = new Date().getTime();

    shapeStyle.display = "block";
    shapeStyle.width = getRandomNumber(50, 250) + "px";
    shapeStyle.height = shapeStyle.width;
    shapeStyle.backgroundColor = getRandomColor();
    if (getRandomBoolean()) {
        shapeStyle.borderRadius = "50%";
    } else {
        shapeStyle.borderRadius = "0";
    }
    shapeStyle.top = getRandomNumber(25, 50) + "%";
    shapeStyle.position = "absolute";
    shapeStyle.left = getRandomNumber(0, 50) + "%";
}

function showTime() {
    shapeStyle.display = "none";

    if (gameStarted) {
        var currentTime = new Date().getTime();
        var diff = (currentTime - startTime) /1000;
        startTime = currentTime;
        timeDisplay.innerHTML = "Your time: " + diff + "s";
    } else {
        gameStarted = true;
    }

    setTimeout(newShape, getRandomNumber(500, 2500));
}

showTime();