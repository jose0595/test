<?php 
	require_once "conexion.php";
	

class catalogoController
{
	
	public function getRestaurantes()
	{
		$conexion= new conexion();
		$conect= $conexion->conectar();

		$query="SELECT cc.id, cc.nombre, cc.concepto_es, cc.concepto_en, cch.hora_inicio, cch.hora_final FROM centros_consumo cc INNER JOIN centros_consumo_horarios cch on cch.centro_consumo_id=cc.id WHERE cc.categoria_id=2";

		 $result=mysqli_query($conect,$query);

		
		 if($result)
		 	return $result->fetch_all(MYSQLI_ASSOC);

		 return false;	
	}

	public function getBares()
	{
		$conexion= new conexion();
	    $conect= $conexion->conectar();

		$query="SELECT cc.id, cc.nombre, cch.hora_inicio, cch.hora_final FROM centros_consumo cc INNER JOIN centros_consumo_horarios cch on cch.centro_consumo_id=cc.id WHERE cc.categoria_id=3";

		$result=mysqli_query($conect,$query);

		
		 if($result)
		 	return $result->fetch_all(MYSQLI_ASSOC);

		 return false;
	}

	public function getDetalleRestaurante($id)
	{

		/* Nombre del centro de consumo
         Concepto
         Logo
         Imagen de portada 
         Mostrar su horario*/
		$conexion= new conexion();
		$conect= $conexion->conectar();

		$query="SELECT cc.nombre, cc.concepto_es, cc.concepto_en, cc.logo, cc.img_portada, cch.hora_inicio, cch.hora_final FROM centros_consumo cc INNER JOIN centros_consumo_horarios cch on cch.centro_consumo_id=cc.id WHERE cc.categoria_id=2 and cc.id='$id' LIMIT 1";

		 $result=mysqli_query($conect,$query);

		 if($result)
		 	return $result->fetch_all(MYSQLI_ASSOC);

		 return false;		
	}

	public function getDetalleBar($id)
	{

		$conexion= new conexion();
	    $conect= $conexion->conectar();

		$query="SELECT cc.nombre, cc.logo, cc.img_portada, cch.hora_inicio, cch.hora_final FROM centros_consumo as cc INNER JOIN centros_consumo_horarios as cch on cch.centro_consumo_id=cc.id WHERE cc.categoria_id=3 and cc.id='$id' LIMIT 1";

		$result= mysqli_query($conect,$query);

		
		 if($result)
		 	return $result->fetch_all(MYSQLI_ASSOC);

		 return false;	
		
	}
}

 ?>