//倒计时js

function ShowCountDown(year, month, day, divname) {
    var now = new Date();
    var endDate = new Date(year, month, day);
    var leftTime = endDate.getTime() - now.getTime();
    var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10);
    var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);
    var mm = parseInt(leftTime / 1000 / 60 % 60, 10);
    var ss = parseInt(leftTime / 1000 % 60, 10);
    dd = checkTime(dd);
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss); //小于10的话加0
    var cc = document.getElementById(divname);
    cc.innerHTML = dd + ":" + hh + ":" + mm + ":" + ss + "";
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

window.setInterval(function () {
    ShowCountDown(2019, 3, 26, 'countdown');
}, 1000);


