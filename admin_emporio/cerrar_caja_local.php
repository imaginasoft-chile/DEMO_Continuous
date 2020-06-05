<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->
<?php 
$cajaid=$_REQUEST["cajaid"];
$cj = negCaja::getCajaDetail($cajaid);
$rcv = negCaja::getCajaVentaAcumulado($cj[0]["accionid"]);
?>
<form name="frm_1" id="frm_1" role="form"  method="post" enctype="multipart/form-data">
	<input type="hidden" name="acc" id="acc" value="CIERRACAJA" />
	<input type="hidden" name="cjd" id=cjd value="<?php echo $cajaid;?>" />
	<input type="hidden" name="monto_fin" id="monto_fin" value="<?php echo (FLOAT)$rcv[0]["total"]+(FLOAT)$cj[0]["monto_inicio"];?>" />	

	

<div class="row" style="margin-top: -50px;     border: 1px solid #a9a9a9;    padding-top: 20px;    padding-bottom: 15px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" >
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div >
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Cerrar Caja</h3>
        		</div>
        		
            	
        		<div class="col-12 margin_bottom_10">
        		<a style="margin-bottom: 10px;"  href="javascript:backW();" class="btn_about_us oswald_font">Volver</a>
        	
        		</div>
               </div>
               
              <div  class="row" style=""  >
	             
	              <div class="col-sm-6" style="min-height:250px;background-color: #2953c317; margin-left: 25%;margin-right: 15%;"> 
	              
	              		
	              		<div style="color: black;">
	                        <div class="panel-heading" style="font-size: 16px;">
	                            <strong><?php echo strtoupper($cj[0]["nombre"]);?> </strong><br />
	                        </div>
	                        <div class="panel-body">
	                        	<ul class="chat">
	                        	
	                        			<li class="left clearfix">
								      		
                                            <div class="form-group">
                                                <label style="margin: 0px;" for="disabledSelect">VENDEDOR: <span style="color: blue;"><?php echo strtoupper($cj[0]["nombre_vendedor"]);?> </span> </label>  
                                                <BR />
                                                <label style="margin: 0px;" for="disabledSelect">FECHA APERTURA: <span style="color: blue;"><?php echo $cj[0]["f_abref"]." ".$cj[0]["f_abreh"];?> </span> </label>                                                
                                            </div>
								      		
								      </li>
								      <hr />
								      <li class="left clearfix">
								      		<span class="chat-img pull-left" style="margin-right: 5px;">
												<img style="height: 25px" src="../images/productos_img.png"  class="img-circle">							        		
								      		</span>
								      	<div class="chat-body clearfix">
								      		<div class="header" >
								            	<strong class="primary-font">
													CANTIDAD DE PRODUCTOS VENDIDOS 
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				<?php echo number_format($rcv[0]["cantidad_prod"],0,',','.');?>
								            	</strong>
								        	</div>
								        	<p>
								           	Total de productos Vendidos	
								        	</p>
								      	</div>
								      </li>
								       <li class="left clearfix">
								      		<span class="chat-img pull-left" style="margin-right: 5px;">
												<img style="height: 25px" src="../images/total_img.png"  class="img-circle">							        		
								      		</span>
								      	<div class="chat-body clearfix">
								      		<div class="header">
								            	<strong class="primary-font">
													MONTO INICIO
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				$ <?php echo number_format($cj[0]["monto_inicio"],0,',','.');?>
								            	</strong>
								        	</div>
								        	<p>
								           	Monto indicado en la apertura de la caja
								        	</p>
								      	</div>
								      </li>
								      <li class="left clearfix">
								      		<span class="chat-img pull-left" style="margin-right: 5px;">
												<img style="height: 25px" src="../images/cash_img.png"  class="img-circle">							        		
								      		</span>
								      	<div class="chat-body clearfix">
								      		<div class="header">
								            	<strong class="primary-font">
													TOTAL DE VENTAS
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				$ <?php echo number_format($rcv[0]["total"],0,',','.');?>
								            	</strong>
								        	</div>
								        	<p>
								           	<a href=" <?php echo util::creaURLApp(0, "detalle_venta","&cajaid=".$cajaid."&accionid=".$cj[0]["accionid"]); ?> "  >[Ver detalle de ventas]</a>
								        	</p>
								      	</div>
								      </li>
								       <li class="left clearfix">
								      		<span class="chat-img pull-left" style="margin-right: 5px;">
												<img style="height: 25px" src="../images/vuelto_img.png"  class="img-circle">							        		
								      		</span>
								      	<div class="chat-body clearfix">
								      		<div class="header">
								            	<strong class="primary-font">
													TOTAL EN LA CAJA
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				$ <?php echo number_format((FLOAT)$rcv[0]["total"]+(FLOAT)$cj[0]["monto_inicio"],0,',','.');?>
								            	</strong>
								        	</div>
								        	<p>
								           	Monto total que debe estar en la caja 
								        	</p>
								      	</div>
								      </li>
								      
	                        	</ul>
	                        </div>
	                        <div class="panel-footer" style="float: right;">
	                            <hr />
	                            <button type="button" data-toggle="modal" data-target="#modalPE"  data-backdrop="static" data-keyboard="false" class="btn btn-success" style="margin: 10px;">CERRAR CAJA</button> 
	                           
	            
	                        </div>
	                    </div>
	              </div>
              </div>
			</div>
		</div>
	</div>
</div>

</form>




<div class="modal fade" id="modalPE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                           
                                            <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
                                        </div>
                                        <div class="modal-body" style="color: black;">
                                        		
                                        		<div class="panel panel-green">
							                       
							                        
							                        
							                        <div class="panel-body">
							                            
							                            <ul class="chat">
	                        	
						                        			
													      <li class="left clearfix">
													      		<span class="chat-img pull-left" style="margin-right: 5px;">
																	<img style="height: 25px" src="../images/total_img.png" class="img-circle">							        		
													      		</span>
													      	<div class="chat-body clearfix">
													      		<div class="header">
													            	<strong class="primary-font">
																		Al cerrar la caja se asume que todos los datos informados estan correctos. <br />
																		
																	</strong>
													            	
													        	</div>
													        
													      	</div>
													      </li>
													      
													      
						                        	
						                        	</ul>
							                            
							                            <br /><br />
							                            
							                            <div class="alert alert-danger alert-dismissable" style="display: none" id="mdg_errorPE">
							                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							                                <div id="mdg_errorPE_txt">
							                                
							                                </div>
							                            </div>
							                            
							                        </div>
							                        <div class="panel-footer" style="float: right;" id="pago_vta_ef" >
							                            <button type="button" onclick="cerrarCaja();"   class="btn btn-primary" style="margin: 6px;">Cerrar Caja</button> 
							                            <button type="button"  data-dismiss="modal" style="margin: 6px;" class="btn btn-danger">Cancelar</button>
							                        </div>
							                        <div class="panel-footer" style="text-align: center; display:none" id="pago_vta_ef_ok" >
							                        	 
							                        	 
							                        	 <div id="mensaje_div-ok" class="success-div">
															La caja se cerro correctamente!!!
															<br />
														</div>
							                        	 <br /><br />
							                            <a type="button" href="<?php echo util::creaURLApp(0, "home");?>"   class="btn btn-primary" style="margin: 6px; float: right;">Entendido</a> 
							                            
							                        </div>
							                    </div>
                                        		
                                        		
                                        	
                                        </div>
                                        <div class="modal-footer">
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


<!-- Modal -->
                            <div class="modal fade" id="msgCargaArtefacto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="color: black;">
                                           
                                            <h4 id="msgmodal-title" class="modal-title" id="myModalLabel">Mensaje</h4>
                                        </div>
                                        <div id="msgModal" class="modal-body" style="text-align: center; style="color: black;"">
                                        		
                                        	<br /><br />
                                        	<img style="width: 55px" src="../images/loading.gif" />   
                                        </div>
                                        <div id="msgmodal-footer"  class="modal-footer">
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


<script type="text/javascript">

function cerrarCaja()
{    
	
		
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "../c_srv/caja.php";
		formalioID = "frm_1";
		srv="CIERRACAJA";

		$("#pago_vta_ef").fadeOut("fast");

		setTimeout(function(){
			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);

				$("#pago_vta_ef_ok").fadeIn('slow');
			

		}, 250);

		

		
	
}

	

</script>