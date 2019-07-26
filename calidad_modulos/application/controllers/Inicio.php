<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* clase inicial para controlar login  
*/
class Inicio extends CI_Controller
{

	public function index()
	{
	
		$this->load->view('layout/login');
	}

	public function token(){
	 	$token = md5(uniqid(rand(),true));
	 	$this->session->set_userdata('token',$token);
	 	return $token;
	}

	public function go_out(){
		redirect('../plataforma_global/ctrl_global/cargar_plataformas','refresh');
	}


}
?>