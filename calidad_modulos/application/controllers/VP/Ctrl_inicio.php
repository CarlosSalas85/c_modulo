<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_inicio extends CI_Controller
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
    $this->template->set('titulo', 'VP Inicio');
    $this->template->set('item_menu', 30);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'VP/Ctrl_inicio/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('VP/iniciovp_view');
  }

  public function graficoToprecursos()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller . 'viviendapilotograficos/1-' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function graficoTopactividades()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller . 'viviendapilotograficos/2-' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }
}
