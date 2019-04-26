var LetsAnimate = require('../animation/requestAnimation.js');
var MenuAccordion = function (elem) {
    this.li        = $(elem);
    this.link      = this.li.children('a');
    this.sub       = this.li.children('ul');
    this.subLi     = this.sub.children('li');
    this.status    = 0;
    this.subHeight = 0;
    this.myAnimation = new LetsAnimate();
    this.myAnimation.setDuration(400);
};

MenuAccordion.prototype = {

    /**
     * run
     * @return {void}
     */
    run: function () {
        this.getHeight();
        this.ancestor();
        $(window).on( 'resize', this.getHeight.bind(this) );
        this.link.on( 'click', this.handler.bind(this) );
        return true;
    },

    /**
     * check if elem is current
     * @return {Boolean} is current
     */
    isCurrent: function () {
        return (this.li.hasClass('current-menu-ancestor') || this.li.hasClass('current-menu-item') || this.li.hasClass('current_page_item') );
    },

    /**
     * get sub menu height
     * @return {integer}
     */
    getHeight: function () {
        if (!this.hasChildren()) return 0;
        var height = 0;
        for (var i = 0; i < this.subLi.length; i++) {
            height += $(this.subLi.get(i)).outerHeight();
        }
        this.subHeight = height;
        return this.subHeight;
    },

    /**
     * open all the current menu
     * @return {boolean}
     */
    ancestor: function () {
        if (!this.hasChildren()) return;
        return this.isCurrent() ? this.openSub() : this.closeSub();
    },

    /**
     * if has children
     * @return {Boolean}
     */
    hasChildren: function () {
        return this.li.hasClass('menu-item-has-children');
    },


    /**
     * event
     * @param  {object} e jquery event
     * @return {void}
     */
    handler: function (e) {
        if ( this.hasChildren() ) {
            e.preventDefault();
            // var _ = this;
            // this.link.off( 'click' );
            // setTimeout(function(){
            //     _.link.on( 'click', _.handler.bind(_) );
            // }, 500);
            return this.getStatus() ? this.closeSub() : this.openSub();
        }
        return !this.isCurrent();
    },

    /**
     * open sub menu
     * @return {boolean}
     */
    openSub: function () {
        var _ = this;
        _.li.addClass( 'is-opened' ).removeClass('is-closed');
        this.myAnimation.request(function () {
            _.sub.css( 'height', _.myAnimation.interpolation(0, _.subHeight) );
        }, function () {
            _.sub.css( 'height', 'auto' );
            _.status = 1;
        });
        return this;
    },
    /**
     * close sub menu
     * @return {boolean}
     */
    closeSub: function () {
        var _ = this;
        var height = this.sub.outerHeight();
        _.li.addClass( 'is-closed' ).removeClass('is-opened');
        this.getHeight();
        this.myAnimation.request(function () {
            _.sub.css('height', _.myAnimation.interpolation(height, 0));
        }, function () {
            _.sub.css('height', 0);
            _.status = 0;
        });


        return this;
    },

    /**
     * is close or open
     * @return {boolean} is open
     */
    getStatus: function () {
        return this.status;
    }

};

module.exports = MenuAccordion;
