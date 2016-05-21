//Cambiar la vista al cambiar el tamano de la pantalla
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('#estilo').empty();
            $('#icono').show();
            $(".login-panel, .panel-heading, .form-control, .input-group-addon").css({'background-color': 'rgba(0, 0, 0, 0)', 'color': '#FFFFFF'});
            $('#estilo').append('body{background: -webkit-linear-gradient(left top, #1D2427, #064552);}');
            $('#aceptar').addClass('btn-outline');
        } else {
            $('#estilo').empty();
            $('#icono').hide();
            $(".login-panel, .form-control").css({'background-color': '#FFFFFF', 'color': '#333'});
            $(".panel-heading, .input-group-addon").css({'background-color': '#f5f5f5', 'color': '#333'});
            //$('#estilo').append('body{box-sizing: border-box;width: 100%;height: 150px;padding: 3px;background-size: 100% 100%;background-image:url(resources/img/login.jpg)');
            $('#estilo').append('body{background: -webkit-linear-gradient(left top, #1D2427, #064552);}');
            $('#aceptar').removeClass('btn-outline');
        }
    });
});