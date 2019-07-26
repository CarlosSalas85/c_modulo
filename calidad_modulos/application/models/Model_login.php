<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_login extends CI_Model { 

   public function __construct() {
      parent::__construct();
   }

   # PLATAFORMA GLOBAL
   # verificar acceso de sesión de usuario global
   public function check_master_user_session($id){
      #se conecta a la bd uci_master
      $db_master = $this->load->database('uci_master', TRUE);
      $db_master->select('token');
      $db_master->from('master_usuario');
      $db_master->where('id',$id);
      $consulta=$db_master->get();
      $resultado = $consulta->row();
      return $resultado;
   }
 
   #datos de usuario
    public function perfil_usuario($username){
      $this->db->select('*');
      $this->db->from('usuario');
      $this->db->where('UsuarioCorreo', $username);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }

   public function login_user($email, $clave){
      $this->db->select('idusuario, usuarioNombre, usuarioPass, perfil_idperfil, usuarioUser, usuarioCorreo');
      $this->db->from('usuario');
      $this->db->where('usuarioUser', $email);
      $this->db->where('usuarioPass', $clave);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }

   public function info_usuario($rut){
      $this->db->select('id, usuario, password, email');
      $this->db->from('usuarios');
      $this->db->where('id', $rut);
       $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }
}