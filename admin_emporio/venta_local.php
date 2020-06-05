<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->

<div class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Ventas en el Local</h3>
        			<hr />
        		</div>
        		
        		<?php 
        		
        			$cajas  = negCaja::getCajas();
        			$uCajas = negCaja::getCajasUsuario($_SESSION["usuarioid"]);
        			
        			
        			foreach ($cajas as $c)
        			{
        				$cajaid = $c["cajaid"];
        				$estado = $c["estado"];
        				$shwCaja = 'n';
        				$goCaja = ' href="'.util::creaURLApp(0, "caja_local","&cajaid=".$cajaid).'" ';
        				
        				foreach ($uCajas as $uc)
        				{
        					if($cajaid== $uc["cajaid"])
        					{
        						$shwCaja = 's';
        					}
        				}
        				
        				if($shwCaja=='s')
        				{
        					
        					$st_ac='';
        					$st_cc='';
        					
        					if($estado == 'CERRADA')
        					{
        						$st_cc=' background-color:#d0d0d0; ';
        						$goCaja= 'href="#" data-toggle="modal" data-target="#modal_mensaje_caja" data-backdrop="static" data-keyboard="false" ';
        					}
        					
        					echo '     	<div class="col-12 margin_bottom_10">
											<h5 style="color:black;">'.$c["nombre"].'</h5>	
											ESTADO: <span style="color: blue;">'.$estado.'</span><br />
											  
							        		<a  style="width: 230px;margin: 10px; font-size: 24px;" class="btn_about_us oswald_font" '.$goCaja.' >  <img src="../images/icon_caja_2.png"  />Caja</a>';
        					if($estado == 'CERRADA')
        					{
        						echo'
							        		<a  style="width: 230px;margin: 10px; font-size: 24px;" class="btn_about_us oswald_font"  onclick="abreCaja(\''.$c["nombre"].'\','.$cajaid.');"  href="#" data-toggle="modal" data-target="#modal_abre_caja" data-backdrop="static" data-keyboard="false"><img src="../images/icon_open.png" /> Abrir Caja</a>';
        					}else
        					{
        						echo'
								            <a  style="width: 230px;margin: 10px; font-size: 24px;'.$st_cc.'" href="'.util::creaURLApp(0, "cerrar_caja","&cajaid=".$cajaid).'" class="btn_about_us oswald_font"> <img src="../images/icon_close.png" />  Cerrar Caja</a>';
        					}
        					
        					
        					if($_SESSION["IGT-perfil"] == 'admin' )
        					{
        					
        					echo'         <a  style="width: 230px;margin: 10px;padding:15px; font-size: 24px;" href="'.util::creaURLApp(0, "informe_caja","&cajaid=".$cajaid).'" class="btn_about_us oswald_font"> <img src="../images/icon_grafico.png"   /> Informes</a>
										  
							';
        					}
        					echo '
								            <hr />
							        	</div>';
        				}
        				
        			}
        		
        		?>
            	
        		
               </div>
              
              <div  class="row" >
	              <div class="col-sm-12" > 
	                
	                </div>
                </div>
                
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_mensaje_caja" tabindex="-1" role="dialog" aria-labelledby="modal_mensaje_caja_Label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel" style="color: black;">Mensaje </h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy">
				<h5><strong>No es posible ir a la caja ya que se encunetra cerrada</strong></h5> 
				
			</div>
			<div class="modal-footer" id="modal_cp_fter">
				<div class="row">
					<div id="btns_cprod_msg" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Entendido</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_abre_caja" tabindex="-1" role="dialog" aria-labelledby="modal_abre_caja_Label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel" style="color: black;">ABRIR CAJA </h3>
					
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy">
				<h4><strong><span class="nombre_caja_span" style="color:#090765"></span></strong></h4> <hr />
				<form method="post" id="frm_abre_caja" name="frm_abre_caja" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="CREAPROD">
                     <input type="hidden" name="cajaid" id="cajaid" value="">
                        <div class="row">
                        	<div class="col-xl-12 col-lg-12  margin_bottom_10">
                            	<label style="color: black; font-weight: 700" ><span style="color:red;">*</span> ASIGNAR VENDEDOR</label>
                            	<div id="selVendedor">
                            	
                            	</div>
                            	                            </div>
                            <div class="col-xl-12 col-lg-12  margin_bottom_10">
                            	<label style="color: black;font-weight: 700" ><span style="color:red;">*</span> MONTO INICIO CAJA</label><br/>
                                <input type="text" class="name w-100 contact_info"  name="monto_ini" id="monto_ini" style="max-width: 120px;" >
                            </div>
                             
                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >NOTA</label>
                                <textarea class="name w-100 contact_info" rows="3"  name="nota" id="nota" placeholder="Puedes agregar alguna nota" ></textarea>
                            </div>
                        </div>
                        <div id="mensaje_div" class="error-div" style="display: none;">
							<div  id="mensaje_login_div_txt">
							</div>
							<br />
						</div>
						<div id="mensaje_div-ok" class="success-div" style="display: none;">
							
							<br />
						</div>

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter">
				<div class="row">
					<div id="btns_cprod" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="doAbreCaja();" style="margin-right: 5px;">Abrir Caja</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button>
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



<script type="text/javascript">

	
	
	function abreCaja(nombre,cajaid)
	{
		$("#cajaid").val(cajaid);
		$(".nombre_caja_span").html(nombre);


		var sv = '<select  name="vendedor" id="vendedor" class="name w-100" style="    height: 30px;">';
					
    			
		var sal =  getDataJson("../c_srv/caja.php","acc=GETUSERBYCAJA&cajaid="+cajaid,"GETUSERBYCAJA","Error 001","NO");
		for(var i=0;i<sal.length;i++)
		{
		  var s=sal[i];

		  var sel = '';
		  if(s.usuarioid == <?php echo $_SESSION["usuarioid"];?>)
		  {
			  sel = ' SELECTED="SELECTED" ';
		  }
		  
		  sv += '<option '+sel+' value="'+s.usuarioid+'">'+s.nombre+'</option>';
		  
		}
		
    	sv += '</select>';

		$("#selVendedor").html(sv);

		
	}

	function doAbreCaja()
	{
		vendedor  			= $("#vendedor").val();
		monto_ini			= $("#monto_ini").val();
		nota				= $("#nota").val();
		
		
		$("#mensaje_div").html('');
		$("#mensaje_div").fadeOut('fast');

		$("#btns_cprod").fadeOut("fast");
		fadeDivs('btns_cprod', 'btns_work','100');
		
		
		
		
		cerr = 0;
		error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

		if(vendedor == 0)
		{
			cerr++;
			error += cerr+'- Debe asignar a un vendedor. <br />';
		}
		
		if(monto_ini != "")
		{
			if(validarSiNumero(monto_ini) == "ERROR")
			{
				cerr++;
				error += cerr+'- Debe indicar el monto inicio solo con números<br />';
			}
		}

		
		if(cerr>0)
		{
			$("#mensaje_div").html(error);
			$("#mensaje_div").fadeIn('fast');
			fadeDivs('btns_work', 'btns_cprod','800');
			
		}else
		{
			msjError = "No pudimos realizar lo solicitado";
			urlIn = "../c_srv/caja.php";
			formalioID = "frm_abre_caja";
			srv="ABRECAJA";
			
			setTimeout(function(){

				var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
				if(sal == "OK")
				{
					
					$("#mensaje_div-ok").html("<strong>La caja fue abierta correctamente!</strong>");
					$("#mensaje_div-ok").fadeIn('fast');
					$("#btns_work").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
					
				}else
				{
					//Error - Muestra mensaje
					$("#mensaje_div").html(sal);
					$("#mensaje_div").fadeIn('fast');
					fadeDivs('btns_work', 'btns_cprod','800');				
				}
			}, 700);


			

		}

		
		
	}

</script>