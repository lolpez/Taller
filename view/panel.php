<script id="jsbin-javascript">
    //Pedir permiso para habilitar notificaciones
    document.addEventListener('DOMContentLoaded', function () {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
    });

    $(document).ready(function() {
        setTimeout(function(){
            notifyMe();
        }, 3000);
    });

    //Notificar
    function notifyMe() {
        if (!Notification) {
            alert('Las notificaciones no estan disponibles para este navegador.');
            return;
        }
        var data = {
            Titulo: 'EPSAS',
            Cuerpo: 'Bienvenido de nuevo. Las notificaciones saldran aqui!',
            Etiqueta: 'idk',
            Icono: 'resources/img/icono.png',
            De: {
                nombre: 'Luis Daniel Lopez Sandi',
                cargo: 'Tu amo supremo'
            },
            Para: {
                nombre: 'Yo',
                descripcion: 'hacer algo'
            }
        };

        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        } else {
            var notification = new Notification(data.Titulo, {
                body: data.Cuerpo,
                icon: data.Icono,
                tag: data.Etiqueta,
                data: data
            })
            notification.onclick = function () {
                alert('mensaje de ' + data.De.nombre + ' para: ' + data.Para.nombre);
            };
        }
    }
</script>