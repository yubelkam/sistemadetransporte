
<?php 
	include('class/class.public.php');

	$objPublic = new Main();

	$listExi = $objPublic->ListExit();
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Transporte IUTAI</title>
<!-- for-mobile-apps -->
	<meta http-equiv="Refresh" content="350;inicio.php" name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	
	<meta name="keywords" content="Client Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	
	<!-- css files -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
	<link href="css/css_slider.css" type="text/css" rel="stylesheet" media="all">
     <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

<!-- header -->
<header>
	<div class="top-head container" href="#inicio">
		<div class="ml-auto text-right right-p">
			 
		</div>
	</div>
	<div class="container">
		<!-- nav -->
		<nav class="py-3 d-lg-flex">
			<div id="logo">
				<h1> <a href="inicio.php"><span class="fa fa-bus"></span> Transporte IUTAI </a></h1>
			</div>
			<label for="drop" class="toggle"><span class="fa fa-bars"> Telefono 0</span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu ml-auto mt-1">
				<li class="active"><a href="inicio.php"> Inicio </a></li>
				<li class=""><a href="#quienesomos">¿Quienes Somos?</a></li>
				 
			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>
<!-- //header -->

<!-- banner -->
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 banner-text-w3ls">
					<!-- banner slider-->
					<div class="csslider infinity" id="slider1">
					 
                        <?php $i = 0;

                        foreach ($listExi as $key => $value){ 
                        	$i++; ?>
							<input type="radio" name="slides" <?php if($i == 1) echo 'checked="checked"'; ?> id="slides_<?php echo $i;?>" />
						<?php }?>
						<ul class="banner_slide_bg">
                      
                        <?php  $i = 0; foreach ($listExi as $key => $value) {
										$id     = $value['id_rutas'];
										$status = $value['estatus_ruta'];

										$TotalRoutes= $objPublic->tableRoutes($id,$status);
										
										$intermedia =($TotalRoutes[0]['city_interme'] =='NO POSEE')? false : $TotalRoutes[0]['city_interme'];
										$origen     = $TotalRoutes[0]['city_origen'];
										$destin     = $TotalRoutes[0]['city_destin'];
							?>
							<li>
									<div class="container-fluid">
										<div class="w3ls_banner_txt  pt-3 mb-3 ">
											<a href="#gal<?php echo $i++;?>"><button Class="btn"  style="color: #fff; background: #f4b200; padding: auto; outline: none; border-radius: 5; width: auto; font-size:auto;"> PARADAS </button></a>
											<br>
											<h3 class="b-w3ltxt text-capitalize mt-md-4"> <?php echo $origen ?></h3>
											<?php if($intermedia){?>
												<h3 class="b-w3ltxt text-capitalize mt-md-4"> <?php echo $intermedia?> </h3>
											<?php }?>
											<h3 class="b-w3ltxt text-capitalize mt-md-4"> <?php echo $destin ?></h3>
											<br>
											<h4><span style="color: #f4b200;"class="fa fa-clock-o pt-3 mb-3" aria-hidden="true"></span> <?php echo $value['hora_salida']?>
											<span style="color: #f4b200;" class="fa fa-calendar pt-3 mb-3" aria-hidden="true"></span> <?php echo $value['fecha_salida']?> </h4>
											<br>
											<h4><span style="color: #f4b200;"class="fa fa-bus pt-3 mb-3" aria-hidden="true"></span> Autobus Nro <?php echo $value['nro_unidad']?></h4>
											<h4><span style="color: #f4b200;"class="fa fa-file" aria-hidden="true"></span> 
												<?php echo $value['motivo_salida'] ?>
										</h4>
										</div>
								</div>
							</li>
								
							<?php } ?>
						
						</ul>
						<div class="navigation">
							<div>
                            <?php $i = 0;
								foreach ($listExi as $key => $value)  {  $i++;?>
									<label for="slides_<?php echo $i ;?>"></label>
								<?php }?>
							</div>
						</div>
					</div>
					<!-- //banner slider-->
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php $i = 0; foreach ($listExi as $key => $value) {?>
			<div id="gal<?php echo $i++;?>" class="pop-overlay animate">
                <div class="popup">
				<li> <h4><i style ="color: #f4b200; center"class="fa fa-child" aria-hidden="true">  ¡Cuida el Transporte!  </i></h4></li>
			<br>
			<?php
				$origen  = $value['id_direccion_origen'];
				$interme = ($value['id_direccion_intermedia'] == 1)? false: $value['id_direccion_intermedia'] ;
				$destin  = $value['id_direccion_destino'];

				$lisStop = $objPublic->stops($origen,$interme,$destin);
				?>
			 
			<?php foreach ($lisStop as $key => $stop) {?>
			 <li> <h4><i class="fa fa-font-awesome" aria-hidden="true"> <?php echo $stop['descrip_parada']?></i></h4></li>
			<?php }?>
			<br>
			<li> <h4>  <i style ="color: #011144;"class="fa fa-comments-o" aria-hidden="true">  Afilia tu parada en el Departamento.  </i></h4></li>
                    <a class="close" href="#">&times;</a>
                </div>
            </div>

<?php }?>
			
<!-- //banner -->
  <!-- banner-bottom -->
 
    <!-- //banner-bottom-->
	<!-- services -->
<section class="services py-5" id="quienesomos">
	<div class="container py-md-5">
	<h3 class="heading text-center mb-3 mb-sm-5"> ¿Quienes Somos?</h3>
		<div class="row service-grid-grids text-center">
			<div class="col-lg-4 col-md-4 service-grid service-grid1 mb-4">
				<div class="service-icon">
					<span class="fa fa-h-square"></span>
				</div>
				<h4 class="mt-3">Mision</h4>
				<p class="mt-3"> Proveer un servicio de transporte público masivo, con avances tecnológicos de primer nivel, en instalaciones seguras y confiables para satisfacer las condiciones de los usuarios facilitando la accesibilidad, frecuencia y cobertura bajo el desempeño de transparencia, equidad y eficiencia. </p>
			</div>
			<div class="col-lg-4 col-md-4 service-grid service-grid2 mb-4">
				<div class="service-icon">
					<span class="fa fa-glide-g"></span>
				</div>
				<h4 class="mt-3">Vision</h4>
				<p class="mt-3">Ser líderes  a nivel universitario de transporte de estudiatil e innovar nuevas herramientas tecnologicas a nuestra unidades de transportes. </p>
			</div>
			
			<div class="col-lg-4 col-md-4 service-grid service-grid3 mb-4">
				<div class="service-icon">
					<span class="fa fa-fighter-jet"></span>
				</div>
				<h4 class="mt-3">Objectivo</h4>
				<p class="mt-3"> Promover el transporte sustentable planeado, administrado teniendo control operativo de los corredores de todas las sedes del IUTAI a nivel estadal para brindar un servicio de  calidad a los usuarios de estas sedes.</p>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-6 p-md-0 mb-4">
				<div class="bg-image-left">	
					<h4> JUNIN</h4>
				</div>
			</div>
			<div class="col-md-6 p-md-0 mb-4">
				<div class="bg-image-right">
					<h4> INDEPEDENCIA</h4>
				</div>
				<div class="row">
					<div class="col-md-6 pr-md-0">
						<div class="bg-image-bottom1">
							<h4> CAPACHO </h4>
						</div>
					</div>
					<div class="col-md-6 pl-md-0">
						<div class="bg-image-bottom2">
							<h4> CARDENAS</h4>
						</div>
					</div>
				</div>	
			</div>	
		</div>		
	</div>		
</section>
<!-- //services -->
 <!-- stats -->
    <section class="stats" id="stats">
	<div class="layer py-md-5 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row stat-grids">
                <div class="col-lg-6 stats-left">
                    <h3 class="heading mb-4 text-li"> Historia </h3>
                    <p class="mb-3">
					Fue fundado el 23 de noviembre del año 1971 bajo el decreto presidencial N° 793 publicado 
					en Gaceta Oficial de la República de Venezuela Nº 29.669 de fecha 24-11-1971. 
					Es el segundo en su género. Fue planificado para dictar carreras específicas y prioritarias para la nación,
					 con un enfoque de estudio teórico-práctico, lo que hace que sus egresados sean muy
					 cotizados a nivel industrial tanto en el ámbito nacional como internacional.
 					</p>
                    <h4> <span>+10</span> De años trabajando para los Estudiantes</h4>
                </div>
                <div class="col-lg-6 grid1 stats-right mt-lg-0 mt-4 pl-5">
                    <div class="row">
                        <div class="col-sm-4 col-6 mb-4">
                            <p class="text-li"> Autobuses</p>
                            <h4 class="text-wh"> 40 </h4>
                            <span class="fa fa-bus mr-2"></span>
                        </div>
                        <div class="col-sm-4 col-6 mb-4">
                            <p> Rutas</p>
                            <h4> 10 </h4>
                            <span class="fa fa-map-marker mr-2"></span>
                        </div>
                        <div class="col-sm-4 col-6 mb-4">
                            <p> Conductores </p>
                            <h4> 50</h4>
                            <span class="fa fa-user-circle mr-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</div>
    </section>
 
    
          
    

<div class="map p-2">
	<iframe  src="https://maps.google.com/maps?q=IUTAI&t=&z=15&ie=UTF8&iwloc=&output=embed" ></iframe> </iframe>
</div>

    <footer class="footer-content py-3">
        <div class="container py-md-3">
            <div class="footer-top text-center">
                <h2>
                    <a class="navbar-brand pt-3 mb-3" href="#inicio">
                        <span class="fa fa-camera-retro"></span> GRACIAS POR VISITARNOS
                    </a>
                </h2>
            </div>
            <div class="row footer-top-inner-vv">
                
            </div>

        </div>
        <!-- //footer bottom -->
    </footer>
    <!-- //footer -->
   <!-- copyright -->
<div class="copy-right-top">
	<p class="copy-right text-center py-4">&copy;  
		<a href=""> </a>
	</p>
</div>
<!-- //copyright -->	
	
<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->



</body>
</html>
