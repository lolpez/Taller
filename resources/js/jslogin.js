//Cambiar la vista al cambiar el tamano de la pantalla
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('#estilo').empty();
            $('#icono').show();
            $(".login-panel, .panel-heading, .form-control, .input-group-addon").css({'background-color': 'rgba(0, 0, 0, 0)', 'color': '#FFFFFF'});
            $('#estilo').append('body{background: -webkit-linear-gradient(left top, #1D2427, #9D0D15);}');
            $('#imagen').insertAfter($('#login'));
        } else {
            $('#estilo').empty();
            $('#icono').hide();
            $(".login-panel, .form-control").css({'background-color': 'rgba(0, 0, 0, 0)', 'color': '#FFFFFF'});
            $(".panel-heading, .input-group-addon").css({'background-color': 'rgba(0, 0, 0, 0)', 'color': '#FFFFFF'});
            $('#estilo').append('body{background: -webkit-linear-gradient(left top, #1D2427, #9D0D15);}');
            $('#login').insertAfter($('#imagen'));
        }
    });
});