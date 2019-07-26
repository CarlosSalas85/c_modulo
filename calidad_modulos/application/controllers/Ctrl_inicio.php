<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_inicio extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->controller = API_CALIDAD;
    $this->load->helpers('menu');
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
    $this->template->set('titulo', 'Inicio');
    $this->template->set('item_menu', 99);

    if (!is_null($this->uri->segment(3))) {
      obra_datos($this->uri->segment(3));
    }

    $ctrl = 'Ctrl_inicio/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('User/home_view');
  }
}
