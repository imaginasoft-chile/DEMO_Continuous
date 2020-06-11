<html>
    <head>
        <!--Title-->
        <title>Emporio Maruri - Ventas en Línea</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <!--description-->
        <meta name="description" content="Bakery is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose  portfolio HTML5 template with ready home page demos.">
        <!--Key Words-->
        <meta name="keywords" content="">
        <!--bootstrap-->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <!--fontawesome style-->
        <link rel="stylesheet" href="../assets/css/fonts-awesome.min.css">
        <!--style-->
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/responsive.css">
        <link rel="shortcut icon" href="../images/logo.png">
    </head>
<body>
    
    <!--Ends Here-->
   
    <table>
    <tr><td>jkjkj</></tr>

    </table>
    
    <!--Contact Form-->
    <section class="bg_contact_form text-center" data-scroll-index="4">
        <div class="container">
            <div class="row margin_bottom_80">
                <div class="col"></div>
                <div class="col-xl-8 col-lg-8">
                 <figure class="margin_bottom_50"><img src="../assets/images/heading_bottom_img.png" alt=""></figure>
                    <h2 class="color_fff">DEMO BIENVENIDA</h2>
                   
                    <img src="../images/logo.png" />
                    <p class="color_fff line_height_30">Ingresa tu nombre de usuario y clave para acceder al sistema.</p>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-xl-8 col-lg-8">
                    <div id="form_result"></div>
                    <form method="post" id="frm_login" name="frm_login">
                    <input type="hidden" name="acc" id="acc" value="VALIDAUSUARIO">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <input type="text" name="usuario" id="usuario" class="name w-100 contact_info" placeholder="Ingresa tu usuario" >
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <input type="password" name="clave" id="clave" class="name w-100 contact_info" placeholder="Ingresa tu clave" onkeypress="goEnter(event)">
                            </div>
                        </div>
                        <div id="mensaje_login_div" style="display: none;">
							
								<div class="card card-tile card-xs bg-success bg-gradient text-center" style=" color: white;">
									<div class="card-body p-4">
										<div class="tile-left" id="mensaje_login_div_txt">
											
										</div>
										
									</div>
								</div>
								<br />
							</div>
							<div id="btn_login_div">
                        		<input type="button" value="Ingresar al sistema" class="submit_btn"  onclick="validaLogin();">
                       		 </div>
                        <br /><br /><br /><br /><br /><br /><br /><br /><br />
                    </form>

                </div>
                <div class="col"></div>
            </div>
        </div>
    </section>
    <!--Ends Here-->
    
    <!--Ends Here-->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.js"></script>
    <script src="../assets/js/jquery.validate.js"></script>
    <script src="../assets/js/scrollIt.js"></script>
    <script src="../js/util.js"></script>
    
    <script type="text/javascript">

	function goEnter(e) {
	    if (e.keyCode === 13 && !e.shiftKey) {
	    	validaLogin();
	    }
	}
	function validaLogin()
	{
		$("#btn_login_div").fadeOut("fast");
		$("#btn_login_div").fadeOut("fast");
		
		$("#mensaje_login_div").fadeIn("slow");
		

		if($("#usuario").val()=="")
		{
			$("#mensaje_login_div_txt").html('Debe ingresar su nombre de usuario para poder acceder al sistema.');
			$("#btn_login_div").fadeIn("fast");
		}else
		{
			if($("#clave").val()=="")
			{
				$("#mensaje_login_div_txt").html('Debe ingresar su clave para poder acceder al sistema.');
				$("#btn_login_div").fadeIn("fast");
			}else
			{
				$("#mensaje_login_div_txt").html('<img alt="" src="../images/Loading.gif" style="    width: 30px;">Estamos validando los datos, por favor espere un momento.');

				//LOGIN FUNCTION PUBLIC
				msjError = "No pudimos realizar lo solicitado";
				urlIn = "../c_srv/cuenta.php";
				formalioID = "frm_login";
				srv="VALIDAUSUARIO";
				
				setTimeout(function(){

					var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
					if(sal == "OK")
					{
						//GOTO INDEX
						goto("./index.php");
					}else
					{
						//Muestra mensaje
						$("#mensaje_login_div_txt").html(sal);
						$("#pb_login").fadeOut("fast");
						$("#btnLoggin").fadeIn("slow");
						$('.progress-bar').css('width', '0%').attr('aria-valuenow', 0).html('0%');
						$("#btn_login_div").fadeIn("fast");

						
					}
					
					
				}, 700);


				
			}

		}
		
	}
		
	</script>
    

</body>

</html>