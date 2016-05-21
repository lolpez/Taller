<?php
require_once 'model/usuario.php';
class UsuarioController {

    private $model;
    private $llave;

    public function __CONSTRUCT() {
        $this->model = new Usuario();
        $this->llave = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
    }

    public function Login() {
        if ((isset($_POST['username']) && isset($_POST['password'])) && (!empty($_POST['username']) && !empty($_POST['password']))) {
            $nombre_archivo = 'resources/users/'.$_POST['username'].'.crip';
            $llave = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
            $texto = $this->desencriptar($nombre_archivo, $llave);
            if ($texto != ''){
                if (($_POST['username']== $texto[0]) && ($_POST['password'] == $texto[1])) {
                    $usuario = $this->model->Login((int)$texto[2]);
                    $_SESSION['usuario'] = $usuario;
                    //$DescripcionBitacora = 'Inicio de sesion';
                    //$this->bitacora->GuardarBitacora($DescripcionBitacora);
                    header('Location: ?k&c=notificacion');
                    return;
                }
            }
        }
        header('Location: login.php?hell');
    }

    function encriptar($nombre_archivo, $llave, $texto){
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $texto_encriptado = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $llave, $texto, MCRYPT_MODE_CBC, $iv);
        $texto_encriptado = $iv . $texto_encriptado;
        $texto_encriptado = base64_encode($texto_encriptado);
        $this->escribirArchivo($nombre_archivo, $texto_encriptado);
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

    function escribirArchivo($nombre_archivo, $texto){
        $myfile = fopen($nombre_archivo , "w") or die("El servidor no cuenta con los permisos para escribir archivos. Por favor reporte inmediatamente al administrador de sistema de EPSAS.");
        fwrite($myfile, $texto);
        fclose($myfile);
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