
window.onload = function () {

    var websocket = document.getElementById('websocket');
    var url = 'ws://54.67.3.109/WebSocketsServer.ashx?chatName=AppTeste';
    //var url = 'ws://192.168.1.100:5296/WebSocketsServer.ashx?chatName=AppTeste';

    ws = new WebSocket(url);

    ws.onerror = function (e) {
        websocket.innerHTML = 'Connection Error';
    }

    ws.onopen = function (e) {
        websocket.innerHTML = 'Connected';
    }

    ws.onmessage = function (e) {
        websocket.innerHTML = e.data.toString();
    }

    ws.onclose = function (e) {
        websocket.innerHTML = 'Closed Connection';
    }

}


document.addEventListener("deviceready", onDeviceReady, false);

var pictureSource;
var destinationType;
var watchGps = null;
var watchAcc = null;
var element = null;
var pushNotification;

function onDeviceReady() {
    //Camera
    pictureSource = navigator.camera.PictureSourceType;
    destinationType = navigator.camera.DestinationType;

    //Verifica Conexao
    checkConnection();

    var element = document.getElementById('device');
    element.innerHTML = 'Device Model: ' + device.model + '<br />' +
                        'Device Cordova: ' + device.cordova + '<br />' +
                        'Device Platform: ' + device.platform + '<br />' +
                        'Device UUID: ' + device.uuid + '<br />' +
                        'Device Version: ' + device.version + '<br />';

    //GPS
    var GpsOptions = { timeout: 30000 };
    watchGps = navigator.geolocation.watchPosition(onSuccessGps, onErrorGps, GpsOptions);

    //Acelerometro
    var AccOptions = { frequency: 1 };
    watchAcc = navigator.accelerometer.watchAcceleration(onSuccessAcc, onErrorAcc, AccOptions);
}

function onSuccessGps(position) {
    var element = document.getElementById('geolocation');
    element.innerHTML = 'Latitude: ' + position.coords.latitude + '<br />' +
                        'Longitude: ' + position.coords.longitude + '<br />' +
                        'Altitude: ' + position.coords.altitude + '<br />' +
                        'Accuracy: ' + position.coords.accuracy + '<br />' +
                        'Altitude Accuracy: ' + position.coords.altitudeAccuracy + '<br />' +
                        'Heading: ' + position.coords.heading + '<br />' +
                        'Speed: ' + position.coords.speed + '<br />' +
                        'Timestamp: ' + Date(position.timestamp) + '<br />';
}

function onErrorGps(error) {
    var element = document.getElementById('geolocation');
    element.innerHTML = 'code: ' + error.code + '\n' +
                        'message: ' + error.message + '\n';
}

function onSuccessAcc(acceleration) {
    var element = document.getElementById('accelerometer');
    element.innerHTML = 'Acceleration X: ' + acceleration.x.toFixed(2) + '<br />' +
                        'Acceleration Y: ' + acceleration.y.toFixed(2) + '<br />' +
                        'Acceleration Z: ' + acceleration.z.toFixed(2) + '<br />' +
                        'Timestamp: ' + Date(acceleration.timestamp) + '<br />';

    $('#accelerometer-element').css({
        'margin-top': acceleration.x * 100 + 'px',
        'margin-left': acceleration.y * 100 + 'px',
    });

    ws.send(Array(acceleration.y, acceleration.x));
}

function onErrorAcc(error) {
    var element = document.getElementById('accelerometer');
    element.innerHTML = 'code: ' + error.code + '\n' +
                        'message: ' + error.message + '\n';
}

function onSuccessCto(contacts) {
    var element = document.getElementById('contact-list');
    element.innerHTML = '';

    var phoneList = '';
    for (var i = 0; i < contacts.length; i++) {
        for (var j = 0; j < contacts[i].phoneNumbers.length; j++) {
            phoneList += '<b>' + contacts[i].displayName + '</b><br />' +
                'Type: ' + contacts[i].phoneNumbers[j].type + '<br />' +
                'Number: ' + contacts[i].phoneNumbers[j].value + '<br />';
        }
    }

    element.innerHTML = phoneList;
};

function onErrorCto(error) {
    var element = document.getElementById('contact-list');
    element.innerHTML = 'code: ' + error.code + '\n' +
                        'message: ' + error.message + '\n';
}

function showAlert() {
    navigator.notification.alert(
        'You are the winner!',
        'Game Over',
        'Done'
    );
}

function playBeep() {
    navigator.notification.beep(1);
}

function vibrate() {
    navigator.notification.vibrate(1000);
}

function checkConnection() {

    var networkState = navigator.connection.type;
    var states = {};
    states[Connection.UNKNOWN] = 'Unknown connection';
    states[Connection.ETHERNET] = 'Ethernet connection';
    states[Connection.WIFI] = 'WiFi connection';
    states[Connection.CELL_2G] = '2G connection';
    states[Connection.CELL_3G] = '3G connection';
    states[Connection.CELL_4G] = '4G connection';
    states[Connection.CELL] = 'Cell generic connection';
    states[Connection.NONE] = 'No network connection';

    var element = document.getElementById('connection');
    element.innerHTML = 'Connection type: ' + states[networkState];

}

function onPhotoDataSuccess(imageData) {
    var smallImage = document.getElementById('smallImage');
    smallImage.style.display = 'block';
    smallImage.src = "data:image/jpeg;base64," + imageData;
}

function onPhotoURISuccess(imageURI) {
    var largeImage = document.getElementById('largeImage');
    largeImage.style.display = 'block';
    largeImage.src = imageURI;
}

function capturePhoto() {
    navigator.camera.getPicture(onPhotoDataSuccess, onFail, {
        quality: 50,
        destinationType: destinationType.DATA_URL
    });
}

function capturePhotoEdit() {
    navigator.camera.getPicture(onPhotoDataSuccess, onFail, {
        quality: 20, allowEdit: true,
        destinationType: destinationType.DATA_URL
    });
}

function getPhoto(source) {
    navigator.camera.getPicture(onPhotoURISuccess, onFail, {
        quality: 50,
        destinationType: destinationType.FILE_URI,
        sourceType: source
    });
}

function onFail(message) {
    alert('Failed because: ' + message);
}

function searchContact(value) {
    var CtoOptions = new ContactFindOptions();
    CtoOptions.filter = value;
    CtoOptions.multiple = true;
    var filter = ["displayName", "phoneNumbers"];
    navigator.contacts.find(filter, onSuccessCto, onErrorCto, CtoOptions);
}