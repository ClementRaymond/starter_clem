var Accordion = require('./Accordion.js');
var scrollTo = require('../scroll/scrollToY.js');

var MenuResponsive = function (menu, button) {
    this.menu       = $(menu);
    this.shadow     = null;
    this.button     = $(button);
    this.status     = 0;
    this.mobileSize = 640;
    this.li         = this.menu.find('.menu li');
    this.run();
};



MenuResponsive.prototype = {

    /**
     * opener
     * @return {[type]} [description]
     */
    run: function () {
        // this.shadow.on('click', this.doWoOpen.bind(this));
        this.creatShadow();

        if (this.menu.hasClass('menu-with-accordion')) this.accordion();

        this.button.on('click', this.doWoOpen.bind(this));
    },


    /**
     * call the method if you want accordion
     * @return {[type]} [description]
     */
    accordion: function () {

        this.myAccordion = [];
        /*Modification 19 juin 2018 :
        * Old vertion was (var i = this.li.length; i > 0; i--)
        * Modified into (var i = this.li.length-1; i >= 0; i--)
        * L'algo ne prennait pas le premier elément a cause du i strictement > a 0
        */
        for (var i = this.li.length-1; i >= 0; i--) {
            var current =  $( this.li.get(i) );
            var currentAccordion = new Accordion(current);
            currentAccordion.run();
            this.myAccordion.push(currentAccordion);
        }
    },

    /**
     * check if we open or not
     * @return {boolean}
     */
    doWoOpen: function (e) {
        e.preventDefault();
        return this.isOpen() ? this.closeMenu() : this.openMenu();
    },

    /**
     * check menu status
     * @return {boolean}
     */
    isOpen: function () {
        return this.status;
    },

    /**
     * [creatShadow description]
     * @return {[type]} [description]
     */
    creatShadow: function () {
        this.shadow = $('<div/>', {
            'class': 'dark-focus-responsive',
            click: this.doWoOpen.bind(this)
        }).appendTo(this.menu);
    },

    /**
     * open the menu
     * @return {[type]} [description]
     */
    openMenu: function () {
        scrollTo(0, null, null, function () {
            $('body').css('overflow', 'hidden');
        });
        this.status = 1;
        return this.menu.addClass('is-opened'),
            this.button.addClass('is-active');
    },

    /**
     * close the menu
     * @return {[type]} [description]
     */
    closeMenu: function () {
        $('body').css('overflow', '');
        this.status = 0;
        return this.menu.removeClass('is-opened'),
            this.button.removeClass('is-active');
    },

    /**
     * get client width
     * @return {[type]} [description]
     */
    getClientWidth: function () {
        return $(window).width();
    },

    /**
     *
     */
    isMobile: function () {
        return this.getClientWidth() <= this.mobileSize;
    },

};

module.exports = MenuResponsive;
