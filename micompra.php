<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
//util class
include ('./c_sistema_util/util.php');
//Factory Class
include ('./c_datos/DBFactory.php');
include './c_negocio/negProducto.php';
include './c_datos/dtProducto.php';

?>
<html>
    <head>
        <!--Title-->
        <title>Emporio Maruri - Mi Compra</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <!--description-->
        <meta name="description" content="Bakery is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose  portfolio HTML5 template with ready home page demos.">
        <!--Key Words-->
        <meta name="keywords" content="">
        <!--bootstrap-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--fontawesome style-->
        <link rel="stylesheet" href="assets/css/fonts-awesome.min.css">
        <!--style-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="shortcut icon" href="assets/images/favicon.png">
    </head>
<body>
    <!--Header-->
    <header class="bg_header fixed-top">
        <nav class="navbar navbar-expand-lg header_navigation w-100">
            <div class="container">
                <a class="logo navbar-brand" href="#"><img src="./images/logo.png" alt="image of logo" class="img-fluid" style="width: 81px;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse outer_menubar justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav menubar margin_0_auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="inicio.php">Inicio </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio.php" >Nosotros</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mi Compra <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio.php" data-scroll-nav="4">Contact</a>
                        </li>
                    </ul>
                    <ul class="top_social_links">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Ends Here-->
   
    <!--Bakery Products Section-->
    <section class="padding_top_100 padding_bottom_80 text-center" data-scroll-index="0" id="section2">
        <div class="container">
            <figure style="margin-top: 30px;" ><img src="assets/images/heading_bottom_img.png" alt=""></figure>
            <h2 class="margin_bottom_50">Mi Compra</h2>
            
            <div class="row" style="position: relative;text-align: left;" > 
            	<div class="col-xl-12 col-lg-12 col-md-12 col-12 outer_product_box">
            	<a href="inicio.php"  class="btn_product_box">Agregar mas productos</a>
            	</div>
            </div>
            <br />
            <?php 
            $productos = negProducto::getProductos();
            if(isset($_SESSION["prd_ct"] ))
            {
            	$arrP = $_SESSION["prd_ct"];
            	$arrP = explode('/', $arrP);
            }
            $vt = 0;
            foreach ($productos as  $p)
            {
            	if($p["estado"]=="ACTIVO" && $p["publicado"]=="SI" )
            	{
            		$muestra = 'N';
            		$cantidad;
            		foreach($arrP as $a)
            		{
            			$sp = explode('|', $a);
            			if($sp[0] == $p["productoid"])
            			{
            				$muestra = 'S';
            				$cantidad = $sp[1];
            			}
            		}
            		if($muestra == 'S')
            		{
            			
            			$vp = (FLOAT)$p["precio_internet"];
            			$vv = $cantidad * $vp;
            			$vt = $vt + $vv;
            			
            			
            			echo ' <div class="row product_list_row margin_bottom_10">';
            			
            			echo '	<div class="col-xl-7 col-lg-7 col-md-7 col-7 outer_product_box">
				                    <div class="row product_list_box">
				                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 product_img">
				                            <figure class="float-center"><img src="'.str_replace("..", ".", $p["imagen"]).'" style="max-height: 80px;margin-left: auto; margin-right: auto;" alt="" class="img-fluid"></figure>
				                        </div>
				                        <div class="col-xl-8 col-lg-8 col-md-8 col-12" style="padding-top:15px;">
				                            <div class="text-left inner_product_list">
				                                <h4>'.$p["nombre"].' <span> <img title="Quitar de mi compra" onclick="deleteProd('.$p["productoid"].');" style="cursor: pointer;" src="images/eliminar.png" /> </span></h4>
				                                <p class="font_size_14 font_weight_300 product_detail">'.$p["descripcion"].'</p>
												Cantidad: 
												<img onclick="doLess('.$p["productoid"].');" style="cursor: pointer;" src="images/less.png" />
													<input id="cant_prod_'.$p["productoid"].'" name="cant_prod_'.$p["productoid"].'" disabled="disabled" style="width: 30px;font-weight: 600; color: #043f5d;text-align: center;font-size: 15px;" value="'.$cantidad.'" />
											    <img onclick="doPlus('.$p["productoid"].','.$p["stock"].');" style="cursor: pointer;" src="images/plus.png" /> 
												
				                            </div>
				                        </div>
				                    </div>
				                </div>
								<div class="col-xl-5 col-lg-5 col-md-5 col-5 outer_product_box">
									<table style="height: 80px">	
										<tr>
											<td style="vertical-align:middle;">
											 
                                              <img style="cursor: pointer;" src="images/money.png" />
												<input  id="val_prod_'.$p["productoid"].'" name="val_prod_'.$p["productoid"].'" disabled="disabled" style="width: 75px;font-weight: 600; color: #000;text-align: right;font-size: 18px;padding-right: 2px;" value="'.number_format($vv,0,",",".").'" />
												<input type="hidden" id="valor_prod_venta_'.$p["productoid"].'" name="valor_prod_venta_'.$p["productoid"].'" value="'.$p["precio_internet"].'" />
											</td>
										</tr>
									</table>
								</div>
								'	;
            			
            			echo '</div> <hr/>';
            		}
            			
            	}
            }
            
            
            echo ' <div class="row product_list_row margin_bottom_10">
						
						<div class="col-xl-7 col-lg-7 col-md-7 col-7 outer_product_box">
				                    <div class="row product_list_box" style="float: right;">
				                        <div class="col-xl-8 col-lg-8 col-md-8 col-12" style="padding-top:15px;">
				                            <div class="text-left inner_product_list">
				                                <br /><h4><strong>TOTAL</strong></h4>
												
				                            </div>
				                        </div>
				                    </div>
				                </div>
								<div class="col-xl-5 col-lg-5 col-md-5 col-5 outer_product_box">
									<table style="height: 80px">	
										<tr>
											<td style="vertical-align:middle;">
											 
                                              <img style="cursor: pointer;" src="images/money.png" />
												<input  id="val_total" name="val_total" disabled="disabled" style="width: 75px;font-weight: 600; color: #000;text-align: right;font-size: 18px;padding-right: 2px;" value="'.number_format($vt,0,",",".").'" />
											</td>
										</tr>
									</table>
								</div>


					</div>';
            
            
            
            
            
            
            ?>
            
           
            <a class="btn_welcome_bakery" data-toggle="modal" onclick="solCompra();" data-target="#modal_admin" data-backdrop="static" data-keyboard="false" >  Solicitar la compra</a>
            
            
        </div>
    </section>
    <!--Ends Here-->
    
    
    
    <!--Ends Here-->
    <!--Footer Section-->
    
    <!--Ends Here-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/bakerycontact-form.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/scrollIt.js"></script>
    <script src="./js/util.js"></script>
    <script>
        jQuery(document).ready(function($){
            $(function() { $.scrollIt(); });


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
                    stagePadding: 50,
                    loop:true,
                    margin:10,
                    nav:false,
                    touchDrag               : true,
                    mouseDrag               : true,
                    dots:true
                },
                768:{
                    items:3,
                    loop:true,
                    margin:10,
                    nav:false,
                    touchDrag               : true,
                    mouseDrag               : true,
                    dots:true
                },
                992:{
                    items:3,
                    loop:true,
                    margin:10,
                    nav:false,
                    touchDrag               : true,
                    mouseDrag               : true,
                    dots:true
                },
                1000:{
                    items:3,
                    loop:false,
                    margin:10,
                    nav:false,
                    touchDrag: false,
                    mouseDrag: false,
                    dots:false
                }
            }
        })
        });
    </script>

<script type="text/javascript">


function doLess(pid)
{
	va = $("#cant_prod_"+pid).val();
	vpa = $("#valor_prod_venta_"+pid).val();
	vt = $("#val_total").val();
	vt = replaceAll(vt,".","");
	if(va > 1)
	{
	 	va = parseInt(va) -1;
	}

	$("#cant_prod_"+pid).val(va);

	vt = parseInt(vt)-parseInt(vpa);

	vpa = parseInt(vpa) * va;
	$("#val_prod_"+pid).val(formatLatino(vpa));
	$("#val_total").val(formatLatino(vt));

	var sal =  getDataJson("./srv_venta.php","acc=CHGCANT&productoid="+pid+"&cant="+va,"CHGCANT","Error 001","NO");
}

function doPlus(pid,stk)
{
	va = $("#cant_prod_"+pid).val();
	vpa = $("#valor_prod_venta_"+pid).val();

		
	va = parseInt(va) +1;

	if(va > parseInt(stk))
	{

		alert("No puedes agregar más productos ya que no tenemos mas stock");
		
	}else
	{
		vt = $("#val_total").val();
		vt = replaceAll(vt,".","");

		vt = parseInt(vt)+parseInt(vpa);

		
		$("#cant_prod_"+pid).val(va);
		vpa = parseInt(vpa) * va;
		$("#val_prod_"+pid).val(formatLatino(vpa));

		$("#val_total").val(formatLatino(vt));
		
		var sal =  getDataJson("./srv_venta.php","acc=CHGCANT&productoid="+pid+"&cant="+va,"CHGCANT","Error 001","NO");
			
	}
		
}

function deleteProd(pid)
{
	var sal =  getDataJson("./srv_venta.php","acc=DELPROD&productoid="+pid,"DELPROD","Error 001","NO");
	reloadLocal();
		
}

function solCompra()
{

		$("#mensaje_div").fadeOut('fast');
		var htm='Total de la compra <img style="cursor: pointer;" src="images/money.png" /><span style="font-size: 23px;"><strong>'+$("#val_total").val()+'</strong></span>';
		$("#tot_sol_compra").html(htm);
	
}
function solComplaVal()
{
	var htm = 'No podemos cursar tu compra, revisalo siguiente <br />';
	var contErr = 0;
	$("#mensaje_div").fadeOut('fast');
	$("#mensaje_div").fadeOut('btns_cprod');
	fadeDivs('btns_cprod', 'btns_work','200');

	if($("#val_total").val() == '0')
	{
		contErr++;
		htm += ' Debe seleccionar al menos 1 producto <br/>';
	}
	
	if($("#nombre ").val() == "")
	{
		contErr++;
		htm += ' Debe indicar su nombre <br/>';
	}

	if($("#direccion ").val() == "")
	{
		contErr++;
		htm += ' Debe indicar su dirección <br/>';
	}

	if($("#telefono ").val() == "")
	{
		contErr++;
		htm += ' Debe indicar su teléfono <br/>';
	}


	if(contErr > 0)
	{
		$("#mensaje_div").html(htm);
		$("#mensaje_div").fadeIn('fast');
		fadeDivs('btns_work', 'btns_cprod','800');
	}else
	{
		//////
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "srv_venta.php";
		formalioID = "frm_submit";
		srv="COMPRA";
		
		setTimeout(function(){
			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
				$("#modal_cp_bdy").html("<strong>La compra fue ingresada Correctamente, sus productos serán enviados a la brevedad!</strong>");
				$("#modal_cp_fter").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		}, 700);
		/////////
	}

	
}
</script>




<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Solicitar Compra</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy" style="font-size: 16px;">
				Para solicitar tu compra debes completar los siguientes datos
				<hr />
				<form method="post" id="frm_submit" name="frm_submit" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="COMPRA">
                        <div class="row">
                        	<div class="col-xl-12 col-lg-12">
                            	<label style="color: black;><span style="color:red;">*</span> Nombre </label>
                                <input type="text" class="name w-100 contact_info"  name="nombre" id="nombre" placeholder="Ingresa tu nombre" >
                            </div>
                            <div class="col-xl-12 col-lg-12">
                            	<label style="color: black;><span style="color:red;">*</span>Dirección (Indicar número y depto) <span style="color:blue;font-size: 13px;">solo atendemos en Independencia</span></label>
                                <input type="text" class="name w-100 contact_info"  name="direccion" id="direccion" placeholder="Ingresa tu dirección completa" >
                            </div>
                            
                            <div class="col-xl-6 col-lg-6">
                            	<label style="color: black;" ><span style="color:red;">*</span> Teléfono</label>
                                <input type="text" class="name w-100 contact_info"  name="telefono" id="telefono" placeholder="" >
                            </div>
                             <div class="col-xl-6 col-lg-6">
                            	<label >Correo</label>
                                <input type="text" class="name w-100 contact_info"  name="correo" id="correo" placeholder="" >
                            </div>
                            
                        </div>
                        <div id="mensaje_div" class="error-div" style="display: none;">
							
							<div  id="mensaje_login_div_txt">
								
							</div>
										
								<br />
							</div>

                    </form>
                    <hr />
                    <strong>Importante:</strong> El pago de la compra se debe realizar al momento de la entrega, el tiempo promedio de entrega es de 10 a 20 min. 
                    <br /><br />
					<p id="tot_sol_compra" style="font-size: 19px;"></p>
			</div>
			<div class="modal-footer" id="modal_cp_fter">
				<div class="row">
					<div id="btns_cprod" class="col-xl-12 col-lg-12">
						<button  type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="solComplaVal();" style="margin-right: 5px; font-size: 18px;">Solicitar la Compra</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal" style="font-size: 18px;">Cancelar</button>
					</div>
				</div>
				<div class="row">
					<div id="btns_work"  class="col-xl-12 col-lg-12" style="display: none;">
						En este momento estamos trabajando...
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



</body>

</html>