<?php
require_once 'view/backup/backup.view.php';
require_once 'model/backup.php';
require_once 'model/usuario.php';
require_once 'model/bitacora.php';
require_once 'model/fachada/permiso.php';

class BackupController {

    private $model;
    private $vista;
    private $item;
    private $usuario;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new BackUp();
        $this->vista = new BackupView();
        $this->bitacora = new Bitacora();
        $this->usuario = new Usuario();
        $this->item = 'backup';
        $fachada = new Permiso();
        $this->permiso = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Verificacion() {
        $bd_accion = $_REQUEST['bd'];
        if (isset ($_REQUEST['pkbackup'])){
            $pkbackup = $_REQUEST['pkbackup'];
        }else{
            $pkbackup = 0;
        }
        switch ($bd_accion){
            case 'Crear':
                $icono = 'plus';
            break;
            case 'Descargar':
                $icono = 'download';
            break;
            case 'Restaurar':
                $icono = 'refresh';
            break;
            case 'Eliminar':
                $icono = 'trash';
            break;
            case 'Subir':
                $icono = 'upload';
            break;
            default:
                $icono = '';
            break;
        }
        $this->vista->Verificacion($bd_accion,$icono,$pkbackup,$this->permiso);
    }

    public function Crear() {
        if (isset($_POST['username']) && isset($_POST['password']) && $this->VerificarUsuario($_POST['username'],$_POST['password'])){
            $exito = $this->model->Guardar();
        }else{
            $exito = false;
        }
        if ($exito){
            $bd_accion = 'Creacion';
            $alerta = 'success';
            $icono = 'check';
            $mensaje = 'Se realizo con exito una nueva copia de seguridad, todos sus datos (registros, documentos, etc)
            estan guardados en un archivo .zip que usted puede restaurarla cuando lo desee.
            Tambien tiene la opcion de poder descargar esta copia de seguridad, guardarlo donde lo desee y poder restaurarlo
            al sistema con la opcion "Restarurar copia de seguridad desde archivo".';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }else{
            $bd_accion = 'Creacion';
            $alerta = 'danger';
            $icono = 'times';
            $mensaje = 'Hubo un error al crear una nueva copia de seguridad por los siguientes casos posibles:<br>
            El usuario no cuenta con los permisos necesarios para la creacion de copias de seguridad (Solo el administrador de sistema tiene acceso a esta funcionalidad).<br>
            El servidor no cuenta con los permisos necesarios para la creacion de copias de seguridad.<br>
            La conexion a la base de datos Mysql no se encuentra disponible.<br>
            La conexion a la base de datos Mongo no se encuentra disponible.<br>
            Si el problema consiste, por favor comunicarse con el administrador de sistema.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }
    }

    public function Descargar() {
        if (isset($_POST['username']) && isset($_POST['password']) && $this->VerificarUsuario($_POST['username'],$_POST['password'])) {
            $archivo = $_POST['pk'];
            $exito = true;
        }else{
            $exito = false;
        }
        if ($exito){
            $bd_accion = 'Descargar';
            $alerta = 'success';
            $icono = 'check';
            $mensaje = 'Su archivo de copia de seguridad con todos sus datos (registros, documentos, etc)
            esta listo para la descarga. Este archivo puede guardarlo donde lo desee y poder restaurarlo al sistema
            con la opcion "Restarurar copia de seguridad desde archivo".';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,$archivo);
        }else{
            $bd_accion = 'Descargar';
            $alerta = 'danger';
            $icono = 'times';
            $mensaje = 'Hubo un error al descargar esta copia de seguridad por los siguientes casos posibles:<br>
            El usuario no cuenta con los permisos necesarios para la creacion de copias de seguridad (Solo el administrador de sistema tiene acceso a esta funcionalidad).<br>
            El servidor no cuenta con los permisos necesarios para la descargar archivos.<br>
            El archivo no existe en los registros del servidor.<br>
            Si el problema consiste, por favor comunicarse con el administrador de sistema.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }
    }

    public function Restaurar() {
        if (isset($_POST['username']) && isset($_POST['password']) && $this->VerificarUsuario($_POST['username'],$_POST['password'])) {
            $archivo = $_POST['pk'];
            $exito = $this->model->Restarurar($archivo);
        }else{
            $exito = false;
        }
        if ($exito){
            $bd_accion = 'Restaurar';
            $alerta = 'success';
            $icono = 'check';
            $mensaje = 'La restauracion de la base de datos se realizo con exito.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }else{
            $bd_accion = 'Restaurar';
            $alerta = 'danger';
            $icono = 'times';
            $mensaje = 'Hubo un error al descargar esta copia de seguridad por los siguientes casos posibles:<br>
            El usuario no cuenta con los permisos necesarios para la creacion de copias de seguridad (Solo el administrador de sistema tiene acceso a esta funcionalidad).<br>
            El servidor no cuenta con los permisos necesarios para la descargar archivos.<br>
            El archivo no existe en los registros del servidor.<br>
            Si el problema consiste, por favor comunicarse con el administrador de sistema.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }
    }

    public function Subir(){
        if (isset($_POST['username']) && isset($_POST['password']) && $this->VerificarUsuario($_POST['username'],$_POST['password'])) {
            $archivo = $_FILES['archivo'];
            $exito = $this->model->Subir($archivo);
        }else{
            $exito = false;
        }
        if ($exito){
            $bd_accion = 'Subir';
            $alerta = 'success';
            $icono = 'check';
            $mensaje = 'La restauracion de la base de datos desde un archivo se realizo con exito.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }else{
            $bd_accion = 'Subir';
            $alerta = 'danger';
            $icono = 'times';
            $mensaje = 'Hubo un error al subir su arhcivo para restaurar por los siguientes casos posibles:<br>
            El usuario no cuenta con los permisos necesarios para subir de copias de seguridad (Solo el administrador de sistema tiene acceso a esta funcionalidad).<br>
            El servidor no cuenta con los permisos necesarios para la subir archivos.<br>
            El servidor no cuenta con los permisos necesarios para la subir archivos de gran tamaño.<br>
            Si el problema consiste, por favor comunicarse con el administrador de sistema.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }
    }

    public function Eliminar(){
        if ( isset($_POST['username']) && isset($_POST['password']) && $this->VerificarUsuario($_POST['username'],$_POST['password'])) {
            $archivo = $_POST['pk'];
            $exito = $this->model->Eliminar($archivo);
        }else{
            $exito = false;
        }
        if ($exito){
            $bd_accion = 'Eliminar';
            $alerta = 'success';
            $icono = 'check';
            $mensaje = 'La eliminacion de la copia de seguridad se realizo con exito.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }else{
            $bd_accion = 'Eliminar';
            $alerta = 'danger';
            $icono = 'times';
            $mensaje = 'Hubo un error al eliminar esta copia de seguridad por los siguientes casos posibles:<br>
            El usuario no cuenta con los permisos necesarios para la creacion de copias de seguridad (Solo el administrador de sistema tiene acceso a esta funcionalidad).<br>
            El servidor no cuenta con los permisos necesarios para la eliminar archivos.<br>
            El archivo no existe en los registros del servidor.<br>
            Si el problema consiste, por favor comunicarse con el administrador de sistema.';
            $this->vista->Resultado($bd_accion,$alerta,$icono,$mensaje,$this->permiso,null);
        }
    }

    public function VerificarUsuario($user,$pass) {
        $nombre_archivo = 'resources/users/'.$user.'.crip';
        $llave = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $texto = $this->desencriptar($nombre_archivo, $llave);
        if ($texto != ''){
            if (($user == $texto[0]) && ($pass == $texto[1])) {
                $usuario = $this->usuario->Login((int)$texto[2]);
                //Verificar que sea administrador de sistema
                if ($usuario->fkcargo == 1){
                    return true;
                }
            }
        }
        return false;
    }

    function desencriptar($nombre_archivo, $llave){
        $texto_encriptado = $this->leerArchivo($nombre_archivo);
        if ($texto_encriptado != '') {
            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $texto_encriptado = base64_decode($texto_encriptado);
            $iv_dec = substr($texto_encriptado, 0, $iv_size);
            $texto_encriptado = substr($texto_encriptado, $iv_size);
            $texto_desencriptado = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $llave, $texto_encriptado, MCRYPT_MODE_CBC, $iv_dec);
            $array = explode('#', $texto_desencriptado);
            return $array;
        }else{
            return '';
        }
    }

    function leerArchivo($nombre_archivo){
        error_reporting(0);
        if (fopen($nombre_archivo, "r")){
            $myfile = fopen($nombre_archivo, "r") or die("El archivo que contiene la informacion confidencial del usuario se encuentra corrupto. Por favor reporte inmediatamente al administrador de sistema de EPSAS.");
            $contenido = fread($myfile,filesize($nombre_archivo));
            fclose($myfile);
            return $contenido;
        }else{
            return '';
        }
    }
}
?>