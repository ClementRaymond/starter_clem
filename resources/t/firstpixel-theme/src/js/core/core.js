var fpCookie = require('./cookie/myCookie.js');
var fpMenu = require('./menu/Menu.js');
var fpScroll = require('./scroll/downarr.js');
var fpFull = require('./fullscreen/fullscreen.js');
// var fpFunction = require('./functions.js');

module.exports = function() {

    // fpFunction()

    // cookie
    new fpCookie();

    /**
     * Menu
     * @param menu className
     * @param button className
     */
    new fpMenu('.menu-responsive-container', '.hamburger-responsive');

    /**
     *  scroll to className
     *  @param className
     */
    fpScroll('.downarr');

    /**
     *  fullscreen className
     */
    fpFull();
};
