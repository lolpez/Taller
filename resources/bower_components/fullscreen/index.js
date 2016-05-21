var enterFullscreen = function(el) {
    if(el.requestFullscreen) {
        el.requestFullscreen();
    } else if(el.msRequestFullscreen) {
        el.msRequestFullscreen();
    } else if(el.mozRequestFullScreen) {
        el.mozRequestFullScreen();
    } else if(el.webkitRequestFullscreen) {
        el.webkitRequestFullscreen();
    } else {
        noFullscreenSupport();
    }
};

var exitFullscreen = function() {
    if(document.exitFullscreen) {
        document.exitFullscreen();
    } else if(document.msExitFullscreen) {
        document.msExitFullscreen();
    } else if(document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if(document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else {
        noFullscreenSupport();
    }
};

var noFullscreenSupport = function() {
    alert('Su navegador no esta disponible para la opcion de pantalla completa.');
};

var fullscreenButton = document.getElementById('fullscreen');
fullscreenButton.addEventListener('click', function(e) {
    e.preventDefault();
    if((window.innerWidth === screen.width && window.innerHeight === screen.height) || (window.fullScreen)) {
        exitFullscreen();
        fullscreenButton.innerHTML = "<i class='fa fa-expand fa-fw'></i> Pantalla completa</a>";
    } else {
        enterFullscreen(document.documentElement);
        fullscreenButton.innerHTML = "<i class='fa fa-compress fa-fw'></i> Salir pantalla completa</a>";
    }
});

var eventList = ["fullscreenchange", "MSFullscreenChange", "mozfullscreenchange", "webkitfullscreenchange"];
for(event in eventList) {
    window.addEventListener(event, function() {
        if(fullscreenButton.querySelector('.fa').classList.contains('fa-compress')) {
            fullscreenButton.querySelector('.fa').classList.add('fa-expand');
            fullscreenButton.querySelector('.fa').classList.remove('fa-compress');
        } else if(fullscreenButton.querySelector('.fa').classList.contains('fa-expand')) {
            fullscreenButton.querySelector('.fa').classList.remove('fa-expand');
            fullscreenButton.querySelector('.fa').classList.add('fa-compress');
        }
    });
}