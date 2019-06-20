/**
 * 显示适配控制
 */
(function (doc, win) {
    var designWidth = 750;
    var scriptEl = document.getElementById('appRemJsLayout');

    if (scriptEl != null) {
        var dataWidth = scriptEl.getAttribute('data-width');
        if (dataWidth > 0) {
            designWidth = dataWidth;
        }
    }
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            if (clientWidth > 768) {
                clientWidth = 768;
            }
            docEl.style.fontSize = 100 * (clientWidth / designWidth) + 'px';
            //console.log(docEl.style.fontSize)
        };
    recalc();
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
