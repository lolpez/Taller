<?php
require_once 'view/usuario/usuario.view.php';
require_once 'model/usuario.php';
require_once 'model/cargo.php';
require_once 'model/bitacora.php';
require_once 'model/fachada/fachada.php';

class UsuarioController {

    private $model;
    private $vista;
    private $item;
    private $cargo;
    private $bitacora;
    private $llave;
    private $menu;

    public function __CONSTRUCT() {
        $this->model = new Usuario();
        $this->vista = new UsuarioView();
        $this->cargo = new Cargo();
        $this->bitacora = new Bitacora();
        $this->llave = pack('H*',"bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $this->item = 'usuario';
        $fachada = new Fachada();
        $this->menu = $fachada->Obtener_Privilegio($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->menu);
    }

    public function Nuevo() {
        $cargos=$this->cargo->Listar();
        $this->vista->Nuevo($cargos,$this->menu);
    }

    public function Editar() {
        $personal= $this->model->Obtener($_REQUEST['pkusuario']);
        $cargos= $this->cargo->Listar();
        $this->vista->Editar($personal,$cargos,$this->menu);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $usuario = $this->model->Obtener($_POST['pk']);
            $nombre_archivo_antiguo = 'resources/users/'.$usuario->archivo;
            $nombre_archivo_nuevo = $_POST['username'].'.crip';
            $datos = array(
                'pk' => $_POST['pk'],
                'ci' => $_POST['ci'],
                'nombre' => $_POST['nombre'],
                'email' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'archivo' => $nombre_archivo_nuevo,
                'fkcargo' => $_POST['cargo']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el usuario '.$_POST['nombre'];
            $tarea = 'modificar';
            if ($exito){
                //Eliminar el archivo antiguo y crear nuevo
                $arrayDesencriptado = $this->desencriptar($nombre_archivo_antiguo,$this->llave);
                unlink($nombre_archivo_antiguo);
                $texto = $_POST['username'].'#'.$arrayDesencriptado[1].'#'.$_POST['ci'];
                $this->encriptar('resources/users/'.$nombre_archivo_nuevo,$this->llave,$texto);
            }
        }else{
            if (!file_exists('resources/users/'.$_POST['username'].'.crip')){
                $datos = array(
                    'ci' => $_POST['ci'],
                    'nombre' => $_POST['nombre'],
                    'email' => $_POST['correo'],
                    'telefono' => $_POST['telefono'],
                    'archivo' => $_POST['username'].'.epsas',
                    'fkcargo' => $_POST['cargo']
                );
                $exito = $this->model->Guardar($datos);
                $DescripcionBitacora = 'se agrego un nuevo usuario '.$_POST['nombre'];
                $tarea = 'agregar';
                if ($exito){
                    //Encriptar nuevo archivo
                    $nombre_archivo = 'resources/users/'.$_POST['username'].'.crip';
                    $texto = $_POST['username'].'#'.$_POST['pass'].'#'.$_POST['ci'];
                    $this->encriptar($nombre_archivo,$this->llave,$texto);
                }
            }else{
                $exito = false;
                $tarea = 'agregar';
            }
        }
        if ($exito){
            $this->bitacora->GuardarBitacora($DescripcionBitacora);
        }
        header('Location: ?c=usuario&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
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
                    $DescripcionBitacora = 'Inicio de sesion';
                    $this->bitacora->GuardarBitacora($DescripcionBitacora);
                    header('Location: ?k&c=notificacion');
                    return;
                }
            }
        }
        header('Location: login.php?hell');
    }

    public function Logout() {
        $DescripcionBitacora = 'Cierre de sesion';
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        session_destroy();
        header('Location: index.php');
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