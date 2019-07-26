<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_nuevo extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->controller = API_MAESTRAS;
    $this->controller2 = API_CALIDAD;
    $this->unysoft = API_UNYSOFT;
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
    $this->template->set('titulo', 'VP Nuevo');
    $this->template->set('item_menu', 31);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'VP/Ctrl_nuevo/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('VP/nuevovp_view');
  }

  public function Presupuesto()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller . 'proyectos/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function cantidadSolicitudes()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'viviendapilotocantidad/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function Tipologias()
  {
    $id = $this->input->post('id');
    $url = $this->unysoft . 'viviendapiloto/titulos/' . $id . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function Proceso()
  {
    $id = $this->input->post('id');
    $cod = $this->input->post('cod');
    $url = $this->unysoft . 'viviendapiloto/titulosact/' . $id . '/' . $cod . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function Actividad()
  {
    $id = $this->input->post('id');
    $cod = $this->input->post('cod');
    $nivel = $this->input->post('nivel');
    $url = $this->unysoft . 'viviendapiloto/actividad/' . $id . '/' . $cod . '/' . $nivel . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function Subactividad()
  {
    $id = $this->input->post('id');
    $cod = $this->input->post('cod');
    $url = $this->unysoft . 'viviendapiloto/actividadrecurso/' . $id . '/' . $cod . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function Recursos()
  {
    $id = $this->input->post('id');
    $cod = $this->input->post('cod');
    $url = $this->unysoft . 'viviendapiloto/actividadrecursodetalle/' . $id . '/' . $cod . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function Registro()
  {
    $data = $this->_setForm();

    $data['fecha'] = FECHA;
    $data['estado'] = 1;
    $data['usuario'] = $_SESSION['idusuario'];

    $url = $this->controller2 . 'viviendapiloto';
    $metodo = 'POST';
    $id = setCurl($url, $metodo, $data);
    echo $id;
  }

  private function _setForm()
  {

    $datos = array(
      'CodigoPresupuesto' => $this->input->post('CodigoPresupuesto'),
      'CodigoActividad' => $this->input->post('CodigoActividad'),
      'CodigoRecurso' => $this->input->post('CodigoRecurso'),
      'DescripcionRecurso' => $this->input->post('DescripcionRecurso'),
      'CodigoUnidad' => $this->input->post('CodigoUnidad'),
      'CantidadRecursoActividad' => $this->input->post('CantidadRecursoActividad'),
      'PrecioRecurso' => $this->input->post('PrecioRecurso'),
      'Obra_idObra' => $this->input->post('Obra_idObra'),
      'nuevaCantidad' => $this->input->post('nuevaCantidad'),
      'nuevoPrecio' => $this->input->post('nuevoPrecio'),
    );
    return $datos;
  }

  public function maeRecursos()
  {
    $url = $this->unysoft . 'recursos/presupuesto';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function detalleRecurso()
  {
    $id = $this->input->post('id');
    $url = $this->unysoft . 'recursos/detalle/' . $id . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function estadosSolicitud()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'viviendapilotoestados/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }
}
