<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctrl_Login extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('is_logged')) {
			switch ($this->session->userdata('id_perfil')) {
				case '2':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '4':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '5':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '34':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '35':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '11':
					redirect('SC/Ctrl_inicio/inicio/0');
				case '10':
					redirect('SC/Ctrl_inicio/inicio/0');
				default:
					redirect('inicio/index');
					break;
			}
		}
	}



	public function logout()
	{
		$this->session->sess_destroy();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		redirect(MASTER_LOGIN, 'refresh');
	}
}
