<?php
class Perfil_usuario extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;


    public  function __construct(){
        parent::__construct();

        // verifica_token();
        $this->load->model('app/Usuario_perfil_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
       
    }


    public function index(){
        $data['_APP_TITLE']              = "Usuarios perfil";        
        $data['_APP_VIEW_NAME']          = "Usuario perfil";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 1);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Perfil");
        $data['scripts'][] = 'propiosScripts/perfil_usuarios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/perfil/modal_perfil_usuario', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/perfil/perfil_usuario_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
    }

    public function InformacionUsuario(){
        json_header();
        $idUsuario =   $this -> input ->post('idU');
       
        $rs = $this->Usuario_perfil_model->InformacionUsuario_perfil($idUsuario);
       

        $data['idUsu'] = $idUsuario;
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Informacion encontrada!" : "no se encontro nada";
        $data["ListaColaboradores"] = $rs;

        echo JSON_ENCODE($data);
    }
    public function actualizarPass(){
        json_header();
        $idUsuario  =   $this -> input ->post('idU');
        $pass       =   $this -> input ->post('pass');
        $passN      =   $this -> input ->post('passN');
        $UpdateData = array(
            'pass'  => $pass,
            'idU'   => $idUsuario,
            'passN' => $passN
        );
        $verificaPass = $this->Usuario_perfil_model->VerificaPass_usuario_perfil($UpdateData);
        if ($verificaPass == true){
           
            $rs = $this->Usuario_perfil_model->UpdatePass_usuario_perfil($UpdateData);
        }
        else{
            $data["Status"] = false;
            $data["Pass"] = "La contraseña es invalida";
            $rs = false;
        }
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se actualizo la contraseña!" : "ERROR en actualizar";
        $data["ListaColaboradores"] = $rs;
        echo JSON_ENCODE($data);
    }

    public function ActualizarPerfil(){
        json_header();
        $idUsuario      =   $this -> input ->post('idU');
        $nombreU        =   $this -> input ->post('nombreU');
        $apellidos      =   $this -> input ->post('apellidos');
        $telefono       =   $this -> input ->post('telefono');
        
        $UpdateData = array(
            'idU'           => $idUsuario,
            'nombreU'       => $nombreU,
            'apellidos'     => $apellidos,
            'telefono'      => $telefono
        );
        $info = $this->Usuario_perfil_model->infoShort($idUsuario);
        $ValidaTel              = $this->Usuario_perfil_model->telSame($UpdateData);
        $telSameDiferente       = $this->Usuario_perfil_model->telSameDiferente($UpdateData);

        if ($ValidaTel == true){
            $data["StatusTe"] = true;
            $data["ResTelefono"] = "telefono valido";
            $rs = $this->Usuario_perfil_model->UpdatePerfil_usuario_perfil($UpdateData);

        }if ($telSameDiferente == true){
            $data["StatusTe"] = false;
            $data["ResTelefono"] = "telefono en uso";
            $data["info"] = $info;
            $rs = false;
        }else{
            $data["StatusTe"] = true;
            $data["ResTelefono"] = "telefono disponible";
            $rs = $this->Usuario_perfil_model->UpdatePerfil_usuario_perfil($UpdateData);
        }

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se actualizo la información!" : "ERROR en actualizar";
        $data["ListaColaboradores"] = $rs;
        echo JSON_ENCODE($data);

       
    }
   

}
?>
