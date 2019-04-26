var LetsAnimate = require('../animation/requestAnimation.js');


/**
 * scroll to y position on the page
 * @param  {integer} scrollTargetY landing target on the page
 * @param  {integer} speed         speed in ms
 * @param  {string}  easing        easing method
 * @return {void}
 */
var scrollToY = function (scrollTargetY, time, easing, callback) {
    // scrollTargetY: the target scrollY property of the window
    // time: time in seconds
    // easing: easing equation to use

    var scrollY     = window.scrollY;
    var currentTime = 0;

    // check param
    scrollTargetY   = scrollTargetY || 0;
    time            = time || 500;
    easing          = easing || 'easeInOutCubic';
    var myAnimation = new LetsAnimate();
    myAnimation
        .setDuration(time)
        .setEase(easing)
        .request(function () {
            window.scrollTo(0, myAnimation.interpolation(scrollY, scrollTargetY));
        }, function () {
            window.scrollTo(0, scrollTargetY);
            if (callback) {
                callback();
            }
        });

};

module.exports = scrollToY;
