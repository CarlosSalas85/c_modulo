<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_inicio extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->controller2 = API_CALIDAD;
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
    $this->template->set('item_menu', 20);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'SC/Ctrl_inicio/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('SC/iniciosc_view');
  }  

  public function graficosCausales()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'graficos/1-' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function graficoRecursos()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'graficos/2-' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function diasAprobar()
  {   
    $data[] = '';
    $url = $this->controller2 . 'graficos/4-0';
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function diasCerrar()
  {   
    $data[] = '';
    $url = $this->controller2 . 'graficos/5-0';
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function cantidadSolicitudes()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'graficos/6-' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  
}
