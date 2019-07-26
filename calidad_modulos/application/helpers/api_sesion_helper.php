<?php 
	#Validación de Sesión a través de API REST
	#Parámetro a enviar es el token de acceso de la sesión actual
	function sesion(){
		/* $data['token'] = $_SESSION['token'];
		$url = API_MAESTRAS.'sesion';

		$ch = curl_init($url);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: master"));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response);

		if ($response->estatus!=200){
			redirect('Ctrl_login/logout');
		}	 */

	}

	#Función para cargar menú de plataformas de usuario
	function _plataformas(){
		/* $data= array();
		$url = API_MAESTRAS.'usuario_deptos_plataformas/'.$_SESSION['idusuario'];
		$ch = curl_init($url);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: master"));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response);

		if ($response->estatus==200){
			$data=$response->datos;
		}

		return $data; */

	}


 ?>