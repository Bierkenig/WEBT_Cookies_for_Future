"use strict";

function clickCookie(){
    let increment = 0.01;
    let opacity = 1;
    let instance = window.setInterval(function() {
        document.getElementById('cookie').style.opacity = opacity;
        document.getElementById('clickHint').style.opacity = opacity;
        document.getElementById('cookiesLeftHint').style.opacity = opacity;
        opacity -= increment;
        if(opacity <= 0){
            document.getElementById('cookie').style.display = 'none';
            document.getElementById('clickHint').style.display = 'none';
            document.getElementById('cookiesLeftHint').style.display = 'none';
            showFortuneQuote();
            window.clearInterval(instance);
        }
    },5)
}

function showFortuneQuote() {
    document.getElementById('fortuneQuoteBox').style.display = 'flex';
    let increment = 0.1;
    let width = 0;
    let instance = window.setInterval(function() {
        document.getElementById('fortuneQuote').style.width = width + 'em';
        width = width + increment;
        if(width > 20){
            let colorIncrement = 0.01;
            let colorOpacity = 0;
            let colorInstance = window.setInterval(function() {
                document.getElementById('fortuneQuote').style.color = 'rgba(0,0,0,' + colorOpacity + ')';
                colorOpacity += colorIncrement;
                if(colorOpacity  >= 1){
                    window.clearInterval(colorInstance);
                }
            },5)
            window.clearInterval(instance);
        }
    },5)
}