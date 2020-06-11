<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$arrP = '';

if(isset($_SESSION["prd_ct"] ))
{
	$arrP = $_SESSION["prd_ct"];
	$arrP = explode('/', $arrP);
}

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
        <title>Emporio Maruri</title>
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
                            <a class="nav-link" href="#" data-scroll-nav="0">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-scroll-nav="1">Nosotros</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="micompra.php" >Mi Compra</a>
                        </li>
                        <!-- 
	                        <li class="nav-item">
	                            <a class="nav-link" href="#" data-scroll-nav="4">Contact</a>
	                        </li>
                         -->
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
            <h2 class="margin_bottom_50">Demo PHP</h2>
            
            <?php 
            $productos = negProducto::getProductos();
            
            $cont = 1;
            foreach ($productos as  $p)
            {
            	if($p["estado"]=="ACTIVO" && $p["publicado"]=="SI" && (float)$p["stock"]>0)
            	{	
            		$btn = '<a href="#" onclick="addCarr('.$p["productoid"].')" class="btn_product_box">Comprar</a> ';
            		if($arrP != '')
            		{
            			foreach($arrP as $a)
            			{
            				$sp = explode('|', $a);
            				if($sp[0] == $p["productoid"])
            				{
            					$btn = '<span><a href="micompra.php" class="btn_welcome_bakery"> <img alt="" src="./images/ok.png" style="width:20px;"> Ver mi compra</a></span>';
            				}
            			}
            		}
            		

            		if($cont == 1)
            		{
            			echo ' <div class="row product_list_row margin_bottom_40">';
            		
            		    echo '
									<div class="col-xl-6 col-lg-6 col-md-6 col-6 outer_product_box">
					                    <div class="row product_list_box">
					                        <div class="col-xl-8 col-lg-8 col-md-8 col-12 second_order">
					                            <div class="text-right inner_product_list">
					                                <h4>'.$p["nombre"].'</h4>
					                                <div class="price_product_list">$'.number_format($p["precio_internet"],0,",",".").'</div>
					                                <p class="font_size_14 font_weight_300 product_detail">'.$p["descripcion"].'</p>
														<br /><span id="btn_carr_'.$p["productoid"].'"> '.$btn.'</span>
					                            </div>
					                        </div>
					                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 product_img first_order">
					                            <figure class="float-center"><img src="'.str_replace("..", ".", $p["imagen"]).'"  style="max-height: 180px;margin-left: auto; margin-right: auto;" alt="" class="img-fluid"></figure>
					                        </div>
					                    </div>
					                </div>    		
						 ';
            		}
            		
            		
            		if($cont == 2)
            		{
            			
            			
            			echo '	<div class="col-xl-6 col-lg-6 col-md-6 col-6 outer_product_box">
				                    <div class="row product_list_box">
				                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 product_img">
				                            <figure class="float-center"><img src="'.str_replace("..", ".", $p["imagen"]).'" style="max-height: 180px;margin-left: auto; margin-right: auto;" alt="" class="img-fluid"></figure>
				                        </div>
				                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
				                            <div class="text-left inner_product_list">
				                                <h4>'.$p["nombre"].'</h4>
				                                <div class="price_product_list">$'.number_format($p["precio_internet"],0,",",".").'</div>
				                                <p class="font_size_14 font_weight_300 product_detail">'.$p["descripcion"].'</p>
												<br /><span id="btn_carr_'.$p["productoid"].'">'.$btn.'</span>
				                            </div>
				                        </div>
				                    </div>
				                </div>'	;
            			
            			
            		
            			echo '</div>';
            			$cont = 0;
            		}
            		
            		
            		$cont++;
            		
            	}
            }
            
            if($cont>1)
            {
            	echo '</div>	';
            }
            
            
            
            
            
            ?>
            
            
            
            
            
            
        </div>
    </section>
    <!--Ends Here-->
    <!--Welcome Bakery Section-->
    <section class="container-fluid" data-scroll-index="1">
        <div class="row d-flex">
            <div class="col-xl-4 col-lg-4 col-12 padding_left_0 flex_1">
                <div class="welcome_img01"></div>
                <div class="welcome_img02"></div>
            </div>
            <div class="col-xl-4 col-lg-4 col-12 text-center flex_1">
                <div class="welcome_box">
                    <h2>Demo Jenkins - Desarrollo</h2>
                    <figure class="margin_bottom_30"><img src="assets/images/heading_bottom_img.png" alt=""></figure>
                    <p class="margin_bottom_30 font_size_16 font_weight_300">Somos un emporio familiar emplazado en un barrio historico de Santiago, atendemos todos los días de 09:00 am hasta las 02:00 am. Puedes contactarte con nosotros enviandonos un correo a contacto@emporiomaruri.cl</p>
                    <a href="#" class="btn_welcome_bakery">Enviar Correo</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-12 padding_right_0 flex_1">
                <div class="welcome_img03"></div>
                <div class="welcome_img04"></div>
            </div>
        </div>
    </section>
    <!--End Here-->
    <!--Our Product Section-->
    
    <!--Ends Here-->
    <!--Whole Wheat Bread Section-->
    <section class="bg_whole_wheat_bread text-center">
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-xl-8 col-lg-8">
                    <h2 class="color_fff">Los mejores productos</h2>
                    <p class="color_fff line_height_30 margin_bottom_50">Emporio maruri, siempre tiene los mejores productos y el mejor servicio para atender a toda la comunidad, visita nuestro negocio y vive la mejor experiencia..</p>
                   <br /><br />
                </div>
                <div class="col"></div>
            </div>
        </div>
    </section>
    <!--Ends Here-->
    
    <!--Client Section-->
    <section class="padding_bottom_100 padding_top_100">
        
    </section>
    <!--Ends Here-->
    <!--Contact Form-->
    
    <!-- 
    <section class="bg_contact_form text-center" data-scroll-index="4">
        <div class="container">
            <div class="row margin_bottom_80">
                <div class="col"></div>
                <div class="col-xl-8 col-lg-8">
                    <h2 class="color_fff">Contact Form</h2>
                    <figure class="margin_bottom_50"><img src="assets/images/heading_bottom_img.png" alt=""></figure>
                    <p class="color_fff line_height_30">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-xl-8 col-lg-8">
                    <div id="form_result"></div>
                    <form method="post" id="contactpage">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <input type="text" name="name" id="name" class="name w-100 contact_info" placeholder="Full Name..." required="">
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <input type="email" name="email" id="email" class="name w-100 contact_info" placeholder="Your Email..." required="">
                            </div>
                        </div>
                        <textarea name="comments" id="comments" cols="30" rows="8" class="w-100 contact_info" placeholder="Your Comment..."></textarea>
                        <input type="submit" name="submit" id="submit" value="Send Message" class="submit_btn">
                    </form>

                </div>
                <div class="col"></div>
            </div>
        </div>
    </section>
     -->
    <!--Ends Here-->
    <!--Footer Section-->
    <section class="padding_bottom_100 padding_top_100 bg_fff">
        <div class="container footer_logo">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 footer_column">
                    <div class="footer_pages_link">
                        <ul class="footer_logo">
                            <li><figure><img src="./images/logo.png" alt="" style="width: 120px;"  class="img-fluid"></figure></li>
                            <li>© 2018- 2019 Emporio Maruri<br>All rights reserved</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 footer_column footer_links">
                    <div class="footer_pages_link">
                        <h4>Revisar</h4>
                        <ul class="footer_pages_link_list">
                            <li><a href="micompra.php">Mi Compra</a></li>
                           
                        </ul>
                    </div>
                </div>
               
                
            </div>
        </div>
    </section>
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





function addCarr(pid)
{

	//$("#btn_carr_"+pid).html('<br /> <span style="border: 1px solid #a26f06;padding: 14px;background-color: #ffab00;font-size: 14px;color: #2b0200;font-family: apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";"> <a> Agreadover carro</a></span>');

	$("#btn_carr_"+pid).html('<span><a href="micompra.php" class="btn_welcome_bakery"> <img alt="" src="./images/ok.png" style="width:20px;"> Ver mi compra</a></span>');
	var sal =  getDataJson("./srv_venta.php","acc=ADDCARR&productoid="+pid+"&cant=1","ADDCARR","Error 001","NO");
	
	$("#guardando").fadeIn("fast");
	$("#msg-guardado").fadeIn("slow");
	
		
	setTimeout(
			  function() 
			  {

				  $("#guardando").fadeOut("fast");
      					
         			
			  }, 1200);
	
}


</script>


<div id="guardando"  tabindex="-1"  style="z-index:9500;display: none; width: 200px;height: 35px;position: fixed; top:0px; right: 0px; background-color: #58ca3e;padding: 7px;" >
    	    	
    	    	<div id="msg-guardado" style="display: none;">
    	    		<img alt="" src="./images/ok.png" style="width:20px;"><span style="font-size: 14px; color: #fff;"> <strong>  Producto Agregado!</strong></span>
    	    	</div>
    	    	
    </div>

</body>

</html>