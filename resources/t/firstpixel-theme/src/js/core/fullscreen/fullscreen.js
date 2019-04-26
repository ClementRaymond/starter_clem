function setFullscreen(){
    var imgBG = document.querySelectorAll('.fullscreen');

    if ( imgBG ) {
        var hauteur = window.innerHeight;
        var admin = document.getElementById('wpadminbar');
        var adminHeight = admin !== null ? admin.clientHeight : 0;
        for(var i = 0; i < imgBG.length; i++){
            imgBG[i].style.height = hauteur - adminHeight + 'px';
        }
    }
}

module.exports = function () {
    window.addEventListener('resize', setFullscreen);
    setFullscreen();
};
