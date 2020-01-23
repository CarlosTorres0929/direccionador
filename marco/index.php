			<?php
	 @$archivo = $_POST['cedula'];
                if( file_exists($archivo) )
                {
                    // Enviamos el PDF al cliente
                     header("Content-type: application/pdf");
                     header("Content-Disposition: inline; filename=".$archivo);
                     header("Content-length: ".filesize($archivo));
                     readfile($archivo);
                }
	?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Examenes Medicos</title>
		<link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/jquery-ui.css">				
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">				
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>	
			<header id="header">
				
				<div class="container main-menu">
					<div class="row align-items-center justify-content-center d-flex">			
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li><a href="index.html">Examenes Medicos</a></li>
				          <li><a href="https://172.17.5.240/ti"> CS Tecnologia e Informatica</a></li>        					          					          		          		          
				        </ul>
				      </nav><!-- #nav-menu-container -->					      		  
					</div>
				</div>
			</header><!-- #header -->
			
			<!-- start banner Area -->
			<section class="banner-area">		
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-between">
						<div class="col-lg-12 banner-content">
							<h6 class="text-white">Despertamos Admiración</h6>
							<h1 class="text-white" style="font-family: calibri;">Crepes & Waffles</h1>
							<p class="text-white">
								En esta pagina podras poner la direccion url para ingresar a ver tus examenes medicos.
							</p>
				
							<?php
							    if ($_SERVER["REQUEST_METHOD"] == "POST") {
							        if ($_POST['vienedelform'] == 'si') {
							            if ($_POST['cedula'] != '') {
							                echo 'Hola ' . $_POST['cedula'];
							                
							            }else{
							                echo 'Has olvidado poner tu cedula';
							            }
							        }
							    }else{
							?>
							<form method="post" class="navbar-form navbar-left" role="search">
								<div class="input-group">
									<input type="hidden" name="vienedelform" value="si" />
							<input type="text" name="cedula" value="" 
								   class="form-control"
       							   placeholder="Ingresa tu cedula"
							        size="30"
							       required>
							       <span class="validity"></span>
							       <br>
							       	</div>
							       	<br>
							       	<div class="input-group-btn">
							       <button type="submit" class="btn btn-danger">Ver Examen Medico</button>
							       </div>

							</form>
							<?php
							 } 
							 ?>
							</div>
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			            <section class="gallery-area section-gap" id="gallery">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-70 col-lg-8">
                            <div class="title text-center">
                                <h1 class="mb-10">Listado De Archivos</h1>
                                <p>Esto es una prueba para listar informacion de archivos.</p>
                            </div>
                        </div>
                    </div> 
                     <?php
                    include_once 'config.inc.php';
                    if (isset($_POST['subir'])) {
                        $nombre = $_FILES['archivo']['name'];
                        $tipo = $_FILES['archivo']['type'];
                        $tamanio = $_FILES['archivo']['size'];
                        $ruta = $_FILES['archivo']['tmp_name'];
                        $destino = "archivos/" . $nombre;
                        if ($nombre != "") {
                        if (copy($ruta, $destino)) {
                            $titulo= $_POST['titulo'];
                            $descri= $_POST['descripcion'];
                            $db=new Conect_MySql();
                            $sql = "INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo) VALUES('$titulo','$descri','$tamanio','$tipo','$nombre')";
                            $query = $db->execute($sql);
                            if($query){
                                echo "Se guardo correctamente";
                            }
                        } else {
                            echo "Error";
                                }
                            }
                        }
                    ?>
             
<br>


                <!-- aqui va el listado de archivos pdf -->
                 <table class="table">
                    <thead class="thead-dark" style="background-color: #2E2E2E; color: #ffffff">
            <tr>
                <td scope="col">titulo</td>
                <td scope="col">descripcion</td>
                <td scope="col">tamaño</td>
                <td scope="col">tipo</td>
                <td scope="col">nombre</td>
            </tr>
            </thead>
        <?php
        
        $db=new Conect_MySql();
            $sql = "select*from tbl_documentos";
            $query = $db->execute($sql);
            while($datos=$db->fetch_row($query)){?>
            <tr>
                <td scope="col"><?php echo $datos['titulo']; ?></td>
                <td scope="col"><?php echo $datos['descripcion']; ?></td>
                <td scope="col"><?php echo $datos['tamanio']; ?></td>
                <td scope="col"><?php echo $datos['tipo']; ?></td>
                <td scope="col"><a href="archivo.php?id=<?php echo $datos['id_documento']?>"><?php echo $datos['nombre_archivo']; ?></a></td>
            </tr>
                
          <?php  } ?>
            
        </table>

                </div>
            </section>
            <!-- End gallery-area Area -->    
		
            
			
				<div class="footer-bottom-wrap">
					<div class="container">
						<div class="row footer-bottom d-flex justify-content-between align-items-center">
							<p class="col-lg-8 col-mdcol-sm-6 -6 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos Los Derechos Reservados | CS Tecnologia e Informatica <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://172.17.5.240/ti" target="_blank">GLPI</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
							
						</div>						
					</div>
				</div>
			</footer>
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="js/popper.min.js"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>		
 			<script src="js/jquery-ui.js"></script>					
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>					
			<script src="js/owl.carousel.min.js"></script>			
            <script src="js/isotope.pkgd.min.js"></script>								
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>