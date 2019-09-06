<?php 
require_once "../hoteles/catalogoController.php";

$catalogo= new catalogoController();
//$accion='mostrarBar';
$result = array('error' => false);

if(isset($_GET['accion'])&&isset($_GET['id']))
	$accion=$_GET['accion'];
	$id=$_GET['id'];


switch ($accion) {

	case 'mostrarRes':
		$restaurante= $catalogo->getDetalleRestaurante($id);
		if($result):
			$result['restaurante']=$restaurante;
			$result['mensaje']= 'exito';
		else:
			$result['mensaje']='Error';
			$result['error']= true;
		endif;
		
		break;

	case 'mostrarBar':
		$bar= $catalogo->getDetalleBar($id);
		if($result):
			$result['bar']=$bar;
			$result['mensaje']= 'exito';
		else:
			$result['mensaje']='Error';
			$result['error']= true;
		endif;
		
		break;
	
	default:
		# code...
		break;
}

echo json_encode($result);
 ?>