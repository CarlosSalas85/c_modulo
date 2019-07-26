<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_pendiente extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->controller =  API_CALIDAD;
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
    $this->template->set('titulo', 'VP Pendientes');
    $this->template->set('item_menu', 32);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'VP/Ctrl_pendiente/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('VP/pendientevp_view');
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
    $url = $this->controller . 'viviendapiloto/' . $id . '-1-' . $idUsuario . '';
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function Eliminar()
  {
    $id = $this->input->post('id');
    $data = array('');
    $url = $this->controller . 'viviendapiloto/' . $id;
    $metodo = 'DELETE';
    $result = setCurl($url, $metodo, $data);
    echo $result;
  }

  public function Aprobar()
  {
    $data = $this->_arregloDatos(2);
    $url = $this->controller . 'viviendapiloto/' . $data['id'];
    $metodo = 'PUT';
    $result = setCurl($url, $metodo, $data);
    echo $result;
  }

  public function Rechazar()
  {
    $data = $this->_arregloDatos(3);
    $url = $this->controller . 'viviendapiloto/' . $data['id'];
    $metodo = 'PUT';
    $result = setCurl($url, $metodo, $data);
    echo $result;
  }


  private function _arregloDatos($estado)
  {
    $datos = array(
      'id' => $this->input->post('id'),
      'nuevaCantidad' => $this->input->post('nuevaCantidad'),
      'nuevoPrecio' => $this->input->post('nuevoPrecio'),
      'estado' => $estado,
      'fecha' => FECHA,
      'usuario' => $_SESSION['idusuario'],
    );
    return $datos;
  }
}
