<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_cerrado extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->controller = API_CALIDAD;
    $this->load->helpers('menu');
    $this->load->helpers('webservice');
  }

  public function index()
  {
    if (!$this->session->userdata('is_logged')) :
      redirect('Ctrl_login/logout');
    endif;
    setlocale(LC_ALL, 'es_CL');
  }

  public function Inicio()
  {
    $this->index();
    $this->template->set('titulo', 'SC Cerrados');
    $this->template->set('item_menu', 25);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'SC/Ctrl_cerrado/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('SC/cerradosc_view');
  }

  public function Listar()
  {
    if ($_SESSION['id_perfil'] != 4) {
      $idUsuario = 0;
    } else {
      $idUsuario = $_SESSION['idusuario'];
    }
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller . 'solicitudestados/' . $_SESSION['id_perfil'] . '-' . $id . '-4-'.$idUsuario.'';
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }  
}
