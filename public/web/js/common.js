//倒计时js
function ShowCountDown(year, month, day, divname) {
    var now = new Date();
    var endDate = new Date(year, month, day);
    var leftTime = endDate.getTime() - now.getTime();
    var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10); //计算剩余的天数
    var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10); //计算剩余的小时数
    var mm = parseInt(leftTime / 1000 / 60 % 60, 10); //计算剩余的分钟数
    var ss = parseInt(leftTime / 1000 % 60, 10); //计算剩余的秒数
    dd = checkTime(dd);
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss); //小于10的话加0
    var cc = document.getElementById(divname);
    cc.innerHTML = dd + "天" + hh + "小时" + mm + "分" + ss + "秒";
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

window.setInterval(function () {
    ShowCountDown(2019, 2, 26, 'countdown');
}, 1000);


