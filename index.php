<?php 
require_once "hoteles/catalogoController.php";

$catalogo= new catalogoController();

$result= $catalogo->getRestaurantes();
$result1= $catalogo->getBares();
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"> 
	<title>Catalogo Oasis</title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body>

<div id="app">
	<hr>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" v-if="restaurantes">
		<h2 align="center">CATALOGO DE RESTAURANTES Y BARES DEL OASIS</h2>
	</div>
	<hr>
 <br>
	<div class="row">

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="restaurantes">
<table class="table table-hover">
  <thead>
    <tr>
      <th colspan="4"><h3>RESTAURANTES OASIS</h3></th>
    </tr>
  </thead>
  <tbody>
  	 <?php 
  	 $nombre= $result[0];
  	 foreach ($result as $value) 
  	 {
  	 if($value['nombre'] <> $nombre){
  	 ?>
    <tr>
      <td><?php echo $value['nombre']; ?></td>
      <td><?php echo $value['concepto_es'].", ".$value['concepto_en'];?></td>
      <td><?php echo $value['hora_inicio']." Hasta las ".$value['hora_final']; ?></td>
      <td>
      	<button class="btn btn-primary" @click="detalles=true;detallesBar=false;mostrar(<?php echo $value['id']?>)">Ver mas..</button>
      </td>
    </tr>
<?php 
	}
	$nombre=$value['nombre']; 
}

 ?>
  </tbody>
</table>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="bares">
		<table class="table table-hover">
  <thead>
    <tr>
      <th colspan="3"><h3>BARES OASIS</h3></th>
    </tr>
	  </thead>
	  <tbody>
	  	 <?php 
	  	$nombre1= $result1[0];
  	 foreach ($result1 as $value) 
  	 {
  	 if($value['nombre'] <> $nombre1){
	  	?>
	    <tr>
	      <td><?php echo $value['nombre']; ?></td>
	      <td><?php echo $value['hora_inicio']." Hasta las ".$value['hora_final']; ?></td>
	      <td>
	      	<button class="btn btn-primary" @click="detallesBar=true;detalles=false;mostrarBar(<?php echo $value['id']?>)">Ver mas</button>
	      </td>
	    </tr>
		<?php 
		}
		$nombre1=$value['nombre']; 
	} 
	?>
	  </tbody>
	</table>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="detalles">
		
			<table class="table table-hover">
	  <thead>
	    <tr>
	      <th colspan="6"><h3>DETALLES</h3></th>
	    </tr>
	  </thead>
		</table>
			<div v-for="restaurante in restaurantes">
		  <p align="center"><img :src="'img/'+restaurante.img_portada" width="250px" height="250px"></p>  
		  <p align="center"><b><h4>{{restaurante.nombre}}</h4></b> <img :src="'img/'+restaurante.logo" width="50px" height="50px"></p>
	      <p>{{restaurante.concepto_en}}, {{restaurante.concepto_es}}</p>
	      <p>Horario de atencion: Lunes a Domingo de {{restaurante.hora_inicio}} a {{restaurante.hora_final}} hrs</p>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="detallesBar">
		
			<table class="table table-hover">
	  <thead>
	    <tr>
	      <th colspan="6"><h3>DETALLES</h3></th>
	    </tr>
	  </thead>
		</table>
		<div v-for="bares in bar">
		  <p align="center"><img :src="'img/'+bares.img_portada" width="250px" height="250px"></p>  
		  <p align="center"><b><h4>{{bares.nombre}}</h4></b> <img :src="'img/'+bares.logo" width="80px" height="80px"> </p>
	      <p>Horario de atencion: Lunes a Domingo de {{bares.hora_inicio}} a {{bares.hora_final}} hrs</p>
			</div>
		</div>
	</div>
	
</div>

<script src="public/js/vue.min.js"></script>
<script src="public/js/axios.min.js"></script>

<script>
	var app= new Vue({
		el:'#app',
		data:{
			detalles:false,
			detallesBar:false,
			restaurantes:true,
			bares:true,
			restaurantes:[],
			bar:[]
		},
		mounted:function() {
			this.mostrar(id)
			this.mostrarBar(idBar)
		},
		methods:{
			mostrar:function(id){
				axios.get('http://localhost/prueba/api/api.php?accion=mostrarRes&id='+id)
				.then(function(response){
					console.log(response);
					if(response.data==""){
						detalles:false;
						detallesBar:false;
						restaurantes:true;
						bares:true;
					}else{
						app.restaurantes=response.data.restaurante
					}
					
				});
			},
			mostrarBar:function(idBar){
				axios.get('http://localhost/prueba/api/api.php?accion=mostrarBar&id='+idBar)
				.then(function(response){
					console.log(response);
					if(response.data==""){
						detallesBar:false;//app.bar="No se han encontrado datos";
					}else{
						app.bar=response.data.bar
					}
					
				});
			}
		}
	});
</script>

</body>
</html>