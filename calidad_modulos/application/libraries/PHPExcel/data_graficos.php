<?php
if(isset($_POST['obra']) && !empty($_POST['tipo'])) {
    $tipo = $_POST['tipo'];
    $obra = $_POST['obra']
    include('funciones.php');
    switch($action) {
        case 'Resumen' : graficoResumen($obra);break;       
    }
}



?>