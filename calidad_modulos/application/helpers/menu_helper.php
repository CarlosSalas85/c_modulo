<?php
defined('BASEPATH') or exit('No direct script access allowed');

function menu_principal()
{
	$obras = obras();
	$contador = 1;
	if (empty($obras)) { 
		$menu = '';
	} else {
		foreach ($obras->datos as $value) {
			$menu[] = array(
				"id" => '',
				"ctrl" => '/' . $value->idproyecto,
				"nombre" => $value->proyectoNombre,
				"contador" => $contador,
			);
			$contador++;
		}
	}
	return $menu;
}

function obra_datos($id)
{
	$obras = obras();
	$nombre = null;

	foreach ($obras->datos as $value) {

		if ($id == $value->idproyecto) {

			$id = $value->idproyecto;
			$nombre = $value->proyectoNombre;
		}
	}

	if (is_null($nombre)) {
		$nombre = 'OBRAS';
		$id = 0;
	}

	$_SESSION['idObra'] = $id;
	$_SESSION['nombreObra'] = $nombre;
}

function obras()
{
	$data[] = '';
	$url = API_MAESTRAS . 'usuario_pp/' . $_SESSION['idusuario'] . '/6';
	$metodo = 'GET';
	$datos =  json_decode(setCurl($url, $metodo, $data));
	return $datos;
}

function menu_modulos()
{

	$menu_modulos = array();

	//MENU SOBRECONSUMO
	$menu_modulos[] = array(
		"id" => 2,
		"ctrl" => '#',
		"nombre" => 'SobreConsumo SC',
		"icono" => 'ft-monitor',
		"active" => false,
		"sub_menu" =>  array(
			array(
				"id" => 20,
				"ctrl" => base_url() . 'SC/Ctrl_inicio/inicio',
				"nombre_row" => 'Inicio SC',
				"icono" => 'ft-bar-chart-2',
				"active" => false
			),
			array(
				"id" => 21,
				"ctrl" => base_url() . 'SC/Ctrl_nuevo/inicio',
				"nombre_row" => 'Nueva SC',
				"icono" => 'ft-save',
				"active" => false
			),
			array(
				"id" => 22,
				"ctrl" => base_url() . 'SC/Ctrl_pendiente/inicio',
				"nombre_row" => 'Pendiente SC',
				"icono" => 'ft-alert-circle',
				"active" => false
			),
			array(
				"id" => 23,
				"ctrl" => base_url() . 'SC/Ctrl_aprobado/inicio',
				"nombre_row" => 'Aprobados SC',
				"icono" => 'ft-check-square',
				"active" => false
			),
			array(
				"id" => 24,
				"ctrl" => base_url() . 'SC/Ctrl_rechazado/inicio',
				"nombre_row" => 'Rechazadas SC',
				"icono" => 'ft-x-square',
				"active" => false
			),
			array(
				"id" => 25,
				"ctrl" => base_url() . 'SC/Ctrl_cerrado/inicio',
				"nombre_row" => 'Cerradas SC',
				"icono" => 'ft-lock',
				"active" => false
			)
		)
	);
	//MENU SOBRECONSUMO

	//MENU VIVIENDAPILOTO
	$menu_modulos[] = array(
		"id" => 3,
		"ctrl" => '#',
		"nombre" => 'ViviendaPiloto VP',
		"icono" => 'ft-home',
		"active" => false,
		"sub_menu" =>  array(
			array(
				"id" => 30,
				"ctrl" => base_url() . 'VP/Ctrl_inicio/inicio',
				"nombre_row" => 'Inicio VP',
				"icono" => 'ft-bar-chart-2',
				"active" => false
			),
			array(
				"id" => 31,
				"ctrl" => base_url() . 'VP/Ctrl_nuevo/inicio',
				"nombre_row" => 'Nueva VP',
				"icono" => 'ft-save',
				"active" => false
			),
			array(
				"id" => 32,
				"ctrl" => base_url() . 'VP/Ctrl_pendiente/inicio',
				"nombre_row" => 'Pendiente VP',
				"icono" => 'ft-alert-circle',
				"active" => false
			),
			array(
				"id" => 34,
				"ctrl" => base_url() . 'VP/Ctrl_aprobado/inicio',
				"nombre_row" => 'Aprobados VP',
				"icono" => 'ft-check-square',
				"active" => false
			),
			array(
				"id" => 35,
				"ctrl" => base_url() . 'VP/Ctrl_rechazado/inicio',
				"nombre_row" => 'Rechazadas VP',
				"icono" => 'ft-x-square',
				"active" => false
			)
		)
	);
	//MENU VIVIENDAPILOTO

	if ($_SESSION['id_perfil'] == 5 || $_SESSION['id_perfil'] == 10) {
		unset($menu_modulos[0]["sub_menu"][1]);
		unset($menu_modulos[1]["sub_menu"][1]);
	}

	if ($_SESSION['id_perfil'] == 34 || $_SESSION['id_perfil'] == 35) {
		unset($menu_modulos[0]["sub_menu"][1]);
		unset($menu_modulos[1]);
	}
	

	return $menu_modulos;
}
