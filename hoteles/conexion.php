<?php 

class conexion 
{
	public function conectar()
	{
		$conect=mysqli_connect('localhost','root','','hoteles');

		return $conect;
	}
}