<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
//util class
include ('../c_sistema_util/util.php');
//Factory Class
include ('../c_datos/DBFactory.php');
include '../c_negocio/negProducto.php';
include '../c_datos/dtProducto.php';
include '../c_negocio/negVenta.php';
include '../c_datos/dtVenta.php';

include '../c_negocio/negCaja.php';
include '../c_datos/dtCaja.php';
include '../c_negocio/negUsuario.php';
include '../c_datos/dtUsuario.php';

include '../c_negocio/negInforme.php';
include '../c_datos/dtInforme.php';

include '../c_negocio/negGasto.php';
include '../c_datos/dtGasto.php';

?>
<!DOCTYPE html>
	<html lang="es">
	<head>
		
		<style type="text/css">
		.filaItem1 { background-color: white;   padding: 8px; color: #000;  font-size: 16px; border-bottom: 1px solid #d4d1d0;width:100%; cursor: pointer; }
		.filaItem0 { background-color: #ececec; padding: 8px; color: #000;  font-size: 16px; border-bottom: 1px solid #d4d1d0;width:100%; cursor: pointer; }		
		</style>
	
	    <?php 
	    	echo util::getHeadHtml("0","Emporio Maruri","si");
		?>	
	</head>
  	<body>
  	
  	<header>
  		<?php 
  		
  		$goModulo = " 0|home";
  		$aplicacionid=0;
  		
  		if(isset($_REQUEST["qwerty"]))
  		{
  			util::decodeParamURL($_REQUEST["qwerty"]);
  			$goModulo = $_REQUEST["pth"];
  		}
  		
  		$mdls = explode("|", $goModulo);
  		$padreid = $mdls[0];
  		$modulo  = $mdls[1];
  		
	  		if($modulo == "caja_local" || $modulo == "cerrar_caja" || $modulo == "detalle_venta")
	  		{
	  			echo util::geHeaderCaja("0");
	  		}else
	  		{
	  			echo util::geHeaderSistem("0");
	  		}
	  		echo util::getJavaFunctions("0");
		?>
					
	    
	</header>
  	
  	
  	<section class="padding_top_100 latest_news_section">
	    <div class="container-fluid">
	    	<div class="container">
					<?php 
				
						$versionJS = "1.".rand(1,50);
						switch ($modulo) {
							case "home":
								include "inicio.php";
							break;
							case "productos":
							    include '../c_negocio/negProveedor.php';
							    include '../c_datos/dtProveedor.php';
								include "./productos.php";
							break;
							case "ventas":
								include "./ventas.php";
							break;
							case "ventas_internet":
								include "./ventas_internet.php";
							break;
							case "ventas_canceladas":
								include "./ventas_canceladas.php";
							break;
							case "ventas_entregadas":
								include "./ventas_entregadas.php";
							break;
							case "ventas_todas":
								include "./ventas_todas.php";
							break;
							case "entregas":
								include "./entregas.php";
							break;
							case "ventas_local":
								include "./venta_local.php";
							break;
							case "caja_local":
								include "./caja_local.php";
							break;
							case "cerrar_caja":
								include "./cerrar_caja_local.php";
							break;
							case "detalle_venta":
								include "./detalle_venta.php";
							break;
							case "informe_caja":
								include "./informe_venta_caja.php";
							break;
							case "informe_caja_venta_x_producto":
								include "./informe_caja_venta_x_producto.php";
							break;
							case "informe_caja_venta_x_apertura":
								include "./informe_caja_venta_x_apertura.php";
							break;
							case "informes":
								include "./informes.php";
							break;
							case "informe_compra_venta_total":
								include "./informe_compra_venta_total.php";
							break;
							case "gastos":
								include "./gastos.php";
							break;
							case "informe_gastos":
								include "./informe_gastos.php";
							break;
							case "informe_detalle_venta":
								include "./informe_detalle_venta.php";
							break;
							case "tipo_producto":
							    include "./tipo_producto.php";
							    break;
							case "proveedores":
							    include '../c_negocio/negProveedor.php'; 
							    include '../c_datos/dtProveedor.php';
							    include "./proveedores.php";
							    break;
							case "informe_familia":
							    include "./informe_familia.php";
							    break;
							
							case "clientes":
								include '../c_negocio/negCliente.php'; 
								include '../c_datos/dtCliente.php';
								include "./clientes.php";
								//echo '<script src="./js/adm_producto.js?V'.$versionJS.'"></script>';
								break;
							
							
						}
						
						?>
			 </div>
	    </div>
	</section>			
					
		<?php 
		
		?>
  		<script src="../js/util.js"></script>
  		<script>
    $('.owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:false,
        touchDrag: true,
        mouseDrag: true,
        dots:false,
        responsive:{
            0:{
                items:1,
                stagePadding: 100,
                loop:true,
                margin:10,
                nav:false,
                touchDrag               : true,
                mouseDrag               : true,
                dots:true
            },
            768:{
                items:2,
                loop:true,
                margin:10,
                nav:false,
                touchDrag               : true,
                mouseDrag               : true,
                dots:true
            },
            992:{
                items:4,
                loop:true,
                margin:10,
                nav:false,
                touchDrag               : true,
                mouseDrag               : true,
                dots:true
            },
            1000:{
                items:4,
                loop:false,
                margin:10,
                nav:false,
                touchDrag: false,
                mouseDrag: false,
                dots:false
            }
        }
    })

    $(window).scroll(function() {
        if ($(this).scrollTop() >= 350) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });

</script>

<script>
    $(document).ready(function() {
        $('#tabla-lista').DataTable({
            responsive: true,
            "language": {
                "lengthMenu": "Mostrando _MENU_ Registros por página",
                "zeroRecords": "No se han encontrados registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No se han encontrados registros",
                "search": "Busqueda",
                "infoFiltered": "(Filtro de _MAX_ registros totales)",
                "paginate": {
                	"previous": "Anterior",
                	"next": "Siguiente",
                	"first":    "Primero",
                    "last":    "Último"
                  }
                
            }
        });
    });
    </script>

</body>
</html>

