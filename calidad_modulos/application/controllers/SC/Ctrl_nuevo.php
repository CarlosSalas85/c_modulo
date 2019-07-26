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
    $this->template->set('titulo', 'SC Nuevo');
    $this->template->set('item_menu', 21);

    if (!is_null($this->uri->segment(4))) {
      obra_datos($this->uri->segment(4));
    }

    $menu = menu_principal();
    $this->template->set('menu', $menu);

    $ctrl = 'SC/Ctrl_nuevo/inicio';
    $this->template->set('ctrl', $ctrl);

    $menu_modulos = menu_modulos();
    $this->template->set('menu_modulos', $menu_modulos);
    $this->template->load_template1('SC/nuevosc_view');
  }

  public function Centrocosto()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller . 'proyectos/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function recursosCentrocosto()
  {
    $id = substr($this->input->post('id'), 0, 3);
    $url = $this->unysoft . 'sobreconsumo/recursos/' . $id . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function ultimoPrecio()
  {
    $id = $this->input->post('id');
    $url = $this->unysoft . 'recursos/ultimoprecio/' . $id . '';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function maeRecursos()
  {
    $url = $this->unysoft . 'recursos/presupuesto';
    $data = setJson($url);
    echo json_encode($data);
  }

  public function obtenerCausales()
  {
    $data[] = '';
    $url = $this->controller2 . 'causales';
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function registroSobreConsumo()
  {
    $data = $this->_setForm();
    $config = [
      "upload_path" => "./assets/img",
      "allowed_types" => "png|jpg|jpeg|pdf"
    ];
    $this->load->library("upload", $config);

    if ($this->upload->do_upload('archivo')) {

      $datos = array("upload_data" => $this->upload->data());
      $data['archivo'] = utf8_encode($datos['upload_data']['file_name']);
    } else {

      $data['archivo'] = '';
    }
    $data['fecha'] = date("Y-m-d");
    $data['estado'] = 1;
    $data['usuario'] = $_SESSION['idusuario'];

    $url = $this->controller2 . 'solicitudes';
    $metodo = 'POST';
    $id = setCurl($url, $metodo, $data);
    echo $id;
  }

  private function _setForm()
  {
    return array(
      'idObra' => $this->input->post('id_obra_sc'),
      'Descripcion' => $this->input->post('Descripcion'),
      'Recurso' => $this->input->post('Recurso'),
      'Unidad' => $this->input->post('Unidad'),
      'Cantidad' => $this->input->post('Cantidad'),
      'Total' => $this->input->post('Total'),
      'cantidad_orden' => $this->input->post('cantidad_orden'),
      'cantidad_porcomp' => $this->input->post('cantidad_porcomp'),
      'cantidad_recep' => $this->input->post('cantidad_recep'),
      'nueva_cantidad' => $this->input->post('nueva_cantidad'),
      'ultimo_precio' => $this->input->post('ultimo_precio'),
      'desviacion' => $this->input->post('desviacion'),
      'sobreConsumo' => $this->input->post('sobreConsumo'),
      'justificacion' => $this->input->post('justificacion'),
    );
  }

  public function RegistroCambioRecurso()
  {

    $data = $this->_setFormCambio();
    $config = [
      "upload_path" => "./assets/img",
      "allowed_types" => "png|jpg|jpeg|pdf"
    ];
    $this->load->library("upload", $config);

    if ($this->upload->do_upload('archivoCambio')) {

      $datos = array("upload_data" => $this->upload->data());
      $data['archivo'] = utf8_encode($datos['upload_data']['file_name']);
    } else {

      $data['archivo'] = '';
    }
    $data['fecha'] = date("Y-m-d");
    $data['estado'] = 1;
    $data['usuario'] = $_SESSION['idusuario'];

    $url = $this->controller2 . 'solicitudes';
    $metodo = 'POST';
    $id = setCurl($url, $metodo, $data);
    echo $id;
  }

  private function _setFormCambio()
  {
    return array(
      'idObra' => $this->input->post('id_obra_cr'),

      'Descripcion' => $this->input->post('DescripcionCambio'),
      'Recurso' => $this->input->post('RecursoCambio'),
      'Unidad' => $this->input->post('UnidadCambio'),

      'Cantidad' => 0,
      'Total' => 0,
      'cantidad_orden' => 0,
      'cantidad_porcomp' => 0,
      'cantidad_recep' => 0,

      'DescripcionAnterior' => $this->input->post('DescripcionAnterior'),
      'RecursoAnterior' => $this->input->post('RecursoAnterior'),
      'UnidadAnterior' => $this->input->post('UnidadAnterior'),

      'CantidadAnterior' => $this->input->post('CantidadAnterior'),
      'TotalAnterior' => $this->input->post('TotalAnterior'),

      'nueva_cantidad' => $this->input->post('nueva_cantidadCambio'),
      'ultimo_precio' => $this->input->post('ultimo_precioCambio'),
      'desviacion' => $this->input->post('desviacionCambio'),
      'sobreConsumo' => $this->input->post('cambioRecursoSelect'),
      'justificacion' => $this->input->post('justificacionCambio'),
    );
  }

  public function registroNoPresupuestado()
  {

    $data = $this->_setFormNo();
    $config = [
      "upload_path" => "./assets/img",
      "allowed_types" => "png|jpg|jpeg|pdf"
    ];
    $this->load->library("upload", $config);

    if ($this->upload->do_upload('archivoNo')) {

      $datos = array("upload_data" => $this->upload->data());
      $data['archivo'] = utf8_encode($datos['upload_data']['file_name']);
    } else {

      $data['archivo'] = '';
    }
    $data['fecha'] = date("Y-m-d");
    $data['estado'] = 1;
    $data['usuario'] = $_SESSION['idusuario'];

    $url = $this->controller2 . 'solicitudes';
    $metodo = 'POST';
    $id = setCurl($url, $metodo, $data);
    echo $id;
  }

  private function _setFormNo()
  {
    return array(
      'idObra' => $this->input->post('id_obra_np'),
      'Descripcion' => $this->input->post('DescripcionNo'),
      'Recurso' => $this->input->post('RecursoNo'),
      'Unidad' => $this->input->post('UnidadNo'),

      'Cantidad' => 0,
      'Total' => 0,
      'cantidad_orden' => 0,
      'cantidad_porcomp' => 0,
      'cantidad_recep' => 0,

      'nueva_cantidad' => $this->input->post('nueva_cantidadNo'),
      'ultimo_precio' => $this->input->post('ultimo_precioNo'),
      'desviacion' => $this->input->post('desviacionNo'),
      'sobreConsumo' => $this->input->post('noPresupuestado'),
      'justificacion' => $this->input->post('justificacionNo'),
    );
  }  

  public function detalleRecurso()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'solicitudesrecurso/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }

  public function historialSolicitud()
  {
    $id = $this->input->post('id');
    $data[] = '';
    $url = $this->controller2 . 'solicitudeshistorial/' . $id;
    $metodo = 'GET';
    $datos = setCurl($url, $metodo, $data);
    echo $datos;
  }
}
