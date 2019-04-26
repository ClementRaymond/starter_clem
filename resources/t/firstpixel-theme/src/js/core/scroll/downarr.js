var scrollToY = require('./scrollToY.js');

/**
 * className downarr
 *
 * exemple : <button class="downarr downarr-styled" data-scrollto="#section-first"></button>
 * @param  {Object} e event
 * @return {function}
 */
function scrollToSection(e) {

    // block default behavior
    e.preventDefault();
    var $this = $(this);

    // if elem existe
    var $elem    = $this.data("scrollto").length !== 0 ? $($this.data("scrollto")) : null;
    var dataEase = $this.data("easing");
    var dataSpeed = $this.data("speed");

    // admin height
    var admin       = document.getElementById('wpadminbar');
    var adminHeight = admin !== null ? admin.clientHeight : 0;

    // return if no location target
    if ( $elem === null || $elem === undefined ) return console.log('%cNo data-scrollto', 'padding: 4px 10px; background: #a00; color: #fff');

    // parameter
    var target = $elem.offset().top - adminHeight;
    var speed  = (dataSpeed === null || dataSpeed === undefined) ? 500 : dataSpeed;
    var ease   = (dataEase === null || dataEase === undefined) ? 'easeInOutCubic' : dataEase;

    return scrollToY(target, speed, ease);
}

module.exports = function(elem) {
    $(document).on('click', elem, scrollToSection);
};
