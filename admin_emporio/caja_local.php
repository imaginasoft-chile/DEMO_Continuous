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
	<input type="hidden" name="acc" id="acc" value="ADDVTA" />
	<input type="hidden" name="cjd" id=cjd value="<?php echo $cajaid;?>" />
	<input type="hidden" name="dv" id="dv" value="" />	
	<input type="hidden" name="total" id="total" value="" />
	<input type="hidden" name="cantidad" id="cantidad" value="" />
	<input type="hidden" name="tipopago" id="tipopago" value="" />
	<input type="hidden" name="descuento" id="descuento" value="" />

<div class="row" style="margin-top: -40px;     border: 1px solid #a9a9a9;    padding-top: 20px;    padding-bottom: 15px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row"  >
	        		<div class="col-7">
	        				<input type="text" class="name w-100 contact_info" name="productoFind" id="productoFind" style="min-width:101%; height: 52px;font-size: 25px;border-color: #6f5d5d;" onchange="javascript:buscaProd();">
	        				
	        				<div style="float: right; margin-top: 5px;">
	        						<a type="button" class="btn" href="<?php echo util::creaURLApp(0, "detalle_venta","&cajaid=".$cajaid."&accionid=".$cj[0]["accionid"]);?> "  style="margin-right: 10px;background-color: #615c5c;" >Detalle de ventas</a>
	        						<a type="button" class="btn btn-danger" href="<?php echo util::creaURLApp(0, "cerrar_caja","&cajaid=".$cajaid);?> "  >Cerrar Caja</a>
	        				</div>	
	        					
	        				<div id="divBusqueda" style="display:none; border: 1px solid #532d1a; border-top: 0px; border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;width:90%; z-index: 10;background-color: #fff; position: absolute; padding: 0px;">
	        					<div style="border-bottom: 1px solid #532d1a;width:100%; z-index: 10;background-color: #532d1a; position: absolute; padding: 5px;color: white;">
	        						BUSQUEDA <button onclick="javascript:borrarBusqueda()" type="button"  class="btn btn-danger btn-sm" style="float: right; font-size: 13px;background-color: #c82333;border-color: #c82333">Cancelar Busqueda</button>
	        					</div>
	        					
									
								
	        					<div style="margin-top: 40px;" id="prodHtmresultado">
	        					</div>		        				
	        				</div>
	        		</div>
	        		<div class="col-5" style="line-height: 0; ">
	        			<table style="float: right;" >
	        				<tr>
	        					<td rowspan="3">
	        						<img src="../images/icon_caja_2.png" style="height: 60px;" /> 
	        					</td>
	        					<td style="font-size: 16px;text-align: right; min-width: 140px;color: black;">			
	        						<strong><?php echo strtoupper($cj[0]["nombre"]);?> </strong><br />
	        					</td>
	        				</tr>
	        				<tr>
	        					<td style="text-align: right;color: #343a40;min-width: 140px;">
	        						<span style="font-size: 14px;">Monto inicio: $<?php echo number_format($cj[0]["monto_inicio"],0,',','.');?> </span>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td style="text-align: right;color: #0c2dd6;min-width: 140px;">
	        						<span style="font-size: 14px;">Monto actual: <strong>$<?php echo number_format($rcv[0]["total"],0,',','.');?> </strong></span>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td colspan="2" style="padding-top: 8px;">
	        						<span style="font-size: 12px;color: black;"><?php echo $cj[0]["f_abref"]." ".$cj[0]["f_abreh"];?> </span>
	        					</td>
	        				</tr>
	        			</table>
	        			
	        		</div>
               </div>
              <div  class="row" >
	              <div class="col-sm-12"> 
					<hr />          
	              </div>
              </div>
              <div  class="row" >
	              <div class="col-sm-8" style="min-height:250px" id="detalleProd"> 
					        
	              </div>
	              <div class="col-sm-4" style="min-height:250px;background-color: #2953c317"> 
	              
	              		
	              		<div style="color: black;">
	                        <div class="panel-heading" style="font-size: 16px;">
	                            <strong><strong><i class="fa fa-ticket"></i> - RESUMEN DE LA VENTA </strong>
	                        </div>
	                        <div class="panel-body">
	                        	<ul class="chat">
	                        	
	                        			<li class="left clearfix">
								      		
                                            <div class="form-group">
                                                <label for="disabledSelect">VENDEDOR: <span style="color: blue;"><?php echo strtoupper($cj[0]["nombre_vendedor"]);?> </span> </label>                                                
                                            </div>
								      		
								      </li>
								      <li class="left clearfix">
								      		<span class="chat-img pull-left" style="margin-right: 5px;">
												<img style="height: 25px" src="../images/productos_img.png"  class="img-circle">							        		
								      		</span>
								      	<div class="chat-body clearfix">
								      		<div class="header" >
								            	<strong class="primary-font">
													CANTIDAD DE PRODUCTOS
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				<span id="cantProdSelVenta"></span>
								            	</strong>
								        	</div>
								        	<p>
								           	Total de productos seleccionados
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
													TOTAL
												</strong>
								            	<strong style="font-size: 20px;" class="pull-right">
								      				$<span id="TotalSelVenta"></span>
								            	</strong>
								        	</div>
								        	<p>
								           	Total de la compra
								        	</p>
								      	</div>
								      </li>
	                        	</ul>
	                        </div>
	                        <div class="panel-footer" style="text-align: center;">
	                            <hr />
	                            <button type="button" data-toggle="modal" data-target="#modalPE"  data-backdrop="static" data-keyboard="false" onclick="pagoOn();"  class="btn btn-success" style="margin: 10px;">EFECTIVO</button> 
	                            <button type="button"  data-toggle="modal" data-target="#modalPE"  data-backdrop="static" data-keyboard="false"  class="btn btn-primary"  data-backdrop="static" data-keyboard="false" onclick="pagoOnTarjeta();" style="margin: 10px;">TARJETA</button>
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
                                           
                                            <h4 class="modal-title" id="myModalLabel">Finalizar Venta</h4>
                                        </div>
                                        <div class="modal-body" style="color: black;">
                                        		
                                        		<div class="panel panel-green">
							                        <div style="font-size: 18px;color: blue;">
							                            PAGO
							                        </div>
							                        <div id="boucherInp">
							                        	Numero de comprobante <input id="boucher" name="boucher"style="margin-left:5px; font-size: 20px;display: inline; width:200px; text-align:right; padding-right: 5px;" type="text" class="form-control" value=""  />
							                        	<hr />
							                        </div>
							                        
							                        
							                        <div class="panel-body">
							                            
							                            <ul class="chat">
	                        	
						                        			
													      <li class="left clearfix">
													      		<span class="chat-img pull-left" style="margin-right: 5px;">
																	<img style="height: 25px" src="../images/productos_img.png" class="img-circle">							        		
													      		</span>
													      	<div class="chat-body clearfix">
													      		<div class="header">
													            	<strong class="primary-font">
																		CANTIDAD DE PRODUCTOS
																	</strong>
													            	<strong style="font-size: 20px;" class="pull-right">
													      				<span id="cantProdSelVentaPE"></span>
													            	</strong>
													        	</div>
													        	<p>
													           	Total de productos seleccionados
													        	</p>
													      	</div>
													      </li>
													      
													      <li class="left clearfix">
													      		<span class="chat-img pull-left" style="margin-right: 5px;">
																	<img style="height: 25px" src="../images/total_img.png" class="img-circle">							        		
													      		</span>
													      	<div class="chat-body clearfix">
													      		<div class="header">
													            	<strong class="primary-font">
																		TOTAL
																	</strong>
													            	<strong style="font-size: 20px;" class="pull-right">
													      				$<span id="TotalSelVentaPE"></span>
													            	</strong>
													        	</div>
													        	<p>
													           	Es el valor total
													        	</p>
													      	</div>
													      </li>
													      
													      <li class="left clearfix">
													      		<span class="chat-img pull-left" style="margin-right: 5px;">
																	<img style="height: 25px" src="../images/cash_img.png" class="img-circle">							        		
													      		</span>
													      	<div class="chat-body clearfix">
													      		<div class="header">
													            	<strong class="primary-font">
																		EFECTIVO
																	</strong>
													            	<strong style="font-size: 20px;" class="pull-right">
													      				$ <input id="efectivo" name="efectivo"   onblur="doVuelto(event,'otro')" onkeypress="doVuelto(event,'enter')"  style="font-size: 20px;display: inline; width:100px; text-align:right; padding-right: 5px;" type="text" class="form-control" value="0"  />
													            	</strong>
													        	</div>
													        	<p>
													           	Valor entregado por el cliente
													        	</p>
													      	</div>
													      </li>
													      <li class="left clearfix">
													      		<span class="chat-img pull-left" style="margin-right: 5px;">
																	<img style="height: 25px" src="../images/vuelto_img.png" class="img-circle">							        		
													      		</span>
													      	<div class="chat-body clearfix">
													      		<div class="header">
													            	<strong class="primary-font">
																		VUELTO
																	</strong>
													            	<strong style="font-size: 20px;" class="pull-right">
													      				$ <input disabled="disabled" id="vuelto" name="vuelto" style=" font-size: 20px; display: inline; width:100px; text-align:right; padding-right: 5px;" type="text" class="form-control" value="0"  />
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
							                        <div class="panel-footer" style="text-align: center;" id="pago_vta_ef">
							                            <button type="button" onclick="finalizaventa();"   class="btn btn-primary" style="margin: 6px;">Finalizar venta</button> 
							                            <button type="button"  data-dismiss="modal" onclick="focusInp()"  style="margin: 6px;" class="btn btn-danger">Cancelar</button>
							                        </div>
							                        <div class="panel-footer" style="text-align: center; display:none" id="pago_vta_ef_ok" >
							                        	 La venta finalizo correctamente 
							                            <button type="button" data-dismiss="modal" onclick="reloadLocal();"   class="btn btn-primary" style="margin: 6px;">Entendido</button> 
							                            
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
var ManagerDir = {
		vd : [],
		vt : []

		}





		
$(document).ready(function() {

	$('#productoFind').keypress(function (e) {
		  if (e.which == 13) {
			  buscaProd();
		    return false;    //<---- Add this line
		  }

		  if(e.which == 0)
		  {
			  selUltimoIngreso();
			  return false;
		  }
		  
		});
	
	focusInp();
	
	
});

function focusInpCierraModal()
{

	console.log("SI");
	$('#msgCargaArtefacto').modal('hide');
	$("#productoFind").focus();
	
}
function focusInp()
{
	$("#productoFind").focus();
}
function pagoOn()
{
	$("#tipopago").val("EFECTIVO");
	$("#boucherInp").fadeOut('fast');
	$("#mdg_errorPE").fadeOut('fast');
	$("#productoFind").focus();
}
function pagoOnTarjeta()
{
	$("#tipopago").val("TARJETA");
	$("#boucherInp").fadeIn('fast');
	$("#mdg_errorPE").fadeOut('fast');
	$("#productoFind").focus();
}function finalizaventa()
{
	total = $("#total").val();	

	var errT = "";

	if($("#tipopago").val() == "TARJETA" && $("#boucher").val() == "")
	{
		errT = "Debe agregar el numero de comprobante";
	}
	
	
	if(total == "" || total == "0" || errT != "" )
	{
		var errores = "<div style=\"width:100%; text-align: left\">Error- No se puede finalizar la venta "+errT+" </div>";
		$("#mdg_errorPE_txt").html(errores);
		$("#mdg_errorPE").fadeIn('fast');
		
		$("#productoFind").focus();

	}else
	{
		ManagerDir.vd = [];
		var denv = "";
        for(var k=0;k<ManagerDir.vt.length;k++){
   	        var im = ManagerDir.vt[k];
   	        denv += im.productoid+"|-|"+im.precio_venta+"|-|"+im.cantidad+"|-|"+im.precio_oferta+"|-|"+im.total+"|-|"+im.condicion_oferta +"{}";
   	   	       
        }

        $("#pago_vta_ef").fadeOut('fast');
		
		
		$("#dv").val(denv );
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "../c_srv/venta_local.php";
		formalioID = "frm_1";
		srv="ADDVTA";



		setTimeout(function(){
			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);

			if(sal == "OK")
			{
				reloadLocal();
			}else
			{
				$("#pago_vta_ef").fadeIn('slow');
				var errores = "<div style=\"width:100%; text-align: left\">"+sal+" </div>";
				$("#mdg_errorPE_txt").html(errores);
				$("#mdg_errorPE").fadeIn('fast');
				
				$("#productoFind").focus();

			}

		}, 180);

		

		
		
		

	}
	
}
function buscaProd()
{	
	productoFind = $("#productoFind").val();
	$("#productoFind").val("");
	//prodHtmDet = $("#detalleProd").html();
	$("#prodHtmresultado").html("");
	prodHtmresultado = "";

	prodHtmDet = "";
	prod = getDataJson("../c_srv/venta_local.php","acc=BUSCAPRODPVENTA&codigo="+productoFind,"BUSCAPRODPVENTA","NO SE PUDO HACER","SI");
	var conError = 0;
	ManagerDir.vt = [];
	if(prod.length == 1)//ENCONTRO EL PRODUCTO  SE AGREGA EN EL DIV DE DETALLE
	{
		
		for(var i = 0; i<prod.length; i++)//SE AGREGA EN EL DIV DE RESULTADO DE BUSQUEDA
	    {
			var t = prod[i];


			if(t.stock == "0")
			{
				conError++;
				 var errorTitle = "Error- debes revisar lo siguiente.";
	    			var errores = "<div style=\"width:100%; text-align: left;color:blue\">No puedes agregar el producto  \""+t.nombre+"\" a la venta ya que NO tiene stock disponible!!!</div>";
	    			var actionModal = '<button type="button"  class="btn btn-primary"  data-dismiss="modal">Entendido</button>';

	    			$("#msgmodal-title").html(errorTitle);
	    			$("#msgModal").html(errores);
	    			$("#msgmodal-footer").html(actionModal);
	    			
	    			$('#msgCargaArtefacto').modal('show');

			}else
			{
				var cantN = 1;
				var entro=0;
				for(var j=0;j<ManagerDir.vd.length;j++)
				{
					
			 	       var im = ManagerDir.vd[j];
					   
			 	       cantN = im.cantidad;
			 	       var cursor = "NO";
			 	       if(t.productoid == im.productoid ){
			 	    	   entro++;
			 	    	   cursor = "SI";
			 	    	   cnt=  replaceAll(replaceAll(im.cantidad,".",""),",",".");
						   cantN++;

						   var stokI = im.stock;

						   if(im.tipo_unidad == 'kilos')
							{
							   stokI = stokI*1000;
							}
						   
						   if(cantN > stokI)
				 	       {
				 	    	    var errorTitle = "Error- debes revisar lo siguiente.";
				    			var errores = "<div style=\"width:100%; text-align: left;color:blue\">No puedes agregar mas de \""+stokI+"\" articulo para el producto \""+im.nombre+"\"!!!</div>";
				    			var actionModal = '<button onclick="javascript:focusInpCierraModal();" type="button" class="btn btn-primary"  >Entendido</button>';

				    			$("#msgmodal-title").html(errorTitle);
				    			$("#msgModal").html(errores);
				    			$("#msgmodal-footer").html(actionModal);
				    			
				    			$('#msgCargaArtefacto').modal('show');
				    			cantN--;
				 	       }
						   
				 	       
			 	       }

				 	      valor_un = im.precio_venta;
				 	     /*
				 	      if(im.precio_oferta != "0")
				 	      {
				 	    	 valor_un = im.precio_oferta;
				 	      }
				 	       */
				 	    cantN 		= parseFloat(cantN);
				 	    valor_un 	= parseFloat(valor_un);
				 	    var co 		= parseFloat(im.condicion_oferta);

				 	   if(im.precio_oferta != "0" && co > 0 )
				 	    {
					 	    if(cantN < co )
					 	    {
					 	    	tot = valor_un * cantN;
					 	    }else
					 	    {
						 	    var dif = cantN/co;
						 	    var pco = (Math.floor(dif))*co;
						 	    var pso =  cantN - pco; 

						 	   tot =  (im.precio_oferta * pco) + (valor_un * pso);
					 	    }
					 	}else
					 	{
					 		valor_un = im.precio_venta;
					 		
					 		if(im.precio_oferta != "0")
					 	    {
					 			valor_un = im.precio_oferta;
					 	    }
						 	      
					 		tot =  parseFloat(valor_un) * cantN;
						}


				 	    if(im.tipo_unidad == 'kilos')
						{
							tot =  (parseFloat(valor_un)/1000) * parseFloat(cantN);
							
						}
				 	 	//cuadratura por ley
						var un = tot.toString()[tot.toString().length -1];
						tot = tot - parseFloat(un);
				 	      
				 	      
				 	     var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":cantN,"precio_oferta":im.precio_oferta,"total":tot,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":cursor};
				 	     ManagerDir.vt.push(obj);
					 	       		 	      
				}

				if(entro ==  0)
				{
					cantN = 1;
					precio_oferta =  t.precio_oferta;
					valor_un = t.precio_venta;
					/*
			 	    if(t.precio_oferta != "0")
			 	    {
			 	    	valor_un = t.precio_oferta;
			 	    }
					*/
					var co = parseFloat(t.condicion_oferta);
					var ct = parseFloat(cantN);
					
					
			 	   if(t.precio_oferta != "0" && co > 0 )
			 	    {
			 		    tot =  parseFloat(valor_un) * parseFloat(cantN);
					   
				 	}else
				 	{
				 		if(t.precio_oferta != "0")
				 	    {
				 			valor_un = t.precio_oferta;
				 	    }
				 		tot =  parseFloat(valor_un) * parseFloat(cantN);
					}

					if(t.tipo_unidad == 'kilos')
					{
						tot =  (parseFloat(valor_un)/1000) * parseFloat(cantN);
						
					}
					//cuadratura por ley
					var un = tot.toString()[tot.toString().length -1];					
					tot = tot - parseFloat(un);

					
			 	      
			 	     var obj = {"imagen":t.imagen,"nombre":t.nombre,"precio_venta":t.precio_venta,"productoid":t.productoid,"cantidad":cantN,"precio_oferta":precio_oferta,"total":tot,"codigo":t.codigo,"stock":t.stock,"condicion_oferta":t.condicion_oferta,"tipo_unidad":t.tipo_unidad,"cursor":"SI"};
			 	     ManagerDir.vt.push(obj);
						
				}
			}
			
			
			
	     } 


		if(conError == 0)
		{

			ManagerDir.vd = [];
	        for(var k=0;k<ManagerDir.vt.length;k++){
	   	        var im = ManagerDir.vt[k];
	   	        var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":im.cantidad,"precio_oferta":im.precio_oferta,"total":im.total,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":im.cursor};
	            ManagerDir.vd.push(obj);   
	        }        
	        pintaDetailProduct();
		}
		
		 $("#divBusqueda").fadeOut("fast");
		
	}else
	{
		prodHtmresultado += '<table style="width: 100%"> ';
		prodHtmresultado += '<tr><td style="color:white;    background-color: #616161;"> Resultados de la busqueda: "'+productoFind+'"</td></tr>';
	      
		for(var i = 0; i<prod.length; i++)//SE AGREGA EN EL DIV DE RESULTADO DE BUSQUEDA
	    {
	        
			var t = prod[i];
			prodHtmresultado += '	<tr onclick="javascript:AddbuscaProd(\''+t.codigo+'\')" >'+
								'		<td class="filaItem1"  onmouseout="this.className=\'filaItem1\';" onmousemove="this.className=\'filaItem0\';"  >'+
								'		<img style="height: 30px" src="'+t.imagen+'" > '+t.nombre+'  <span style="font-size:12px;color:blue"><strong>['+t.stock+']</strong></span>'+ 
								'			<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 14px;background-color: #03374a;margin:1px; float: right;"'+
								'						type="button" class="btn btn-primary"'+
								'						 >'+
								'			 + Agregar </button>'+
								'		</td>'+
								'	</tr>';
		
		      
	     } 

		prodHtmresultado += '</table>'+
							'<br />';
		$("#divBusqueda").fadeIn("fast");

	}
	$("#prodHtmresultado").html(prodHtmresultado);
	$("#productoFind").focus();
	

    
}

function pintaDetailProduct()
{
	prodHtmDet = "";
	var cantProd = 0;
    var subTotalVenta = 0;
    
	for(var l=0;l<ManagerDir.vd.length;l++)
	{
 	       var im = ManagerDir.vd[l];
 	       var condicion="";
 	       if(im.condicion_oferta != "0")
 	       {
				condicion = '<span style="color:blue"> Oferta X '+im.condicion_oferta+'<span>';
 	 	   }
 	      var valorProd = '<strike style="margin-right:10px;color:#777777;">$'+number_format (im.precio_venta, 0, ",", ".")+'</strike>$'+number_format (im.precio_oferta, 0, ",", ".")+' '+condicion;
 	      if(im.precio_oferta == '0')
 	      {
 	    	 valorProd = '$'+number_format (im.precio_venta, 0, ",", ".");    
 	      }

 	      prodHtmDet += '<div class="row"> <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">'+
	      '		<span class="chat-img pull-left">'+
	      '  		<img style="height: 30px" src="'+im.imagen+'"  >'+
	      '		</span>'+
	      '	<div style="color:black;">'+
	      '      	<strong class="primary-font">'+im.nombre+'</strong> <spam>('+im.tipo_unidad+')</spam>'+
	      '      	<strong class="pull-right">'+
	      '				<table><tr>'+
	      '         	 <td style="width:50px; text-align:right;padding-right: 10px;"> '+valorProd+'</td>'+
	      '<td><a type="button" onclick="javascript:sumarRestaCantidad(\'resta\',\'imp_prod_'+im.productoid+'\','+im.productoid+',event,\'otro\','+im.stock+');" class="btn" style="color:black;margin-left:5px;">-</a></td>'+
	      '         	 <td style="width:35px;">'+
	      '                  	<input onblur="cambiacantProd('+im.productoid+',event,\'otro\','+im.stock+')" onkeypress="cambiacantProd('+im.productoid+',event,\'enter\','+im.stock+')" id="imp_prod_'+im.productoid+'" style="width:55px; text-align:right; padding-right: 5px;" type="text" class="form-control" value="'+im.cantidad+'"  />'+
	      '						<input type="hidden"  id="ant_imp_prod_'+im.productoid+'"  value="'+im.cantidad+'"  />'+
	      '               </td>'+
	      '<td><a type="button" onclick="javascript:sumarRestaCantidad(\'suma\',\'imp_prod_'+im.productoid+'\','+im.productoid+',event,\'otro\','+im.stock+');" class="btn" style="color:black;margin-left:5px;">+</a></td>'+
	      '         	 <td style="width:80px; text-align:right">$'+number_format (im.total, 0, ",", ".")+'</td>'+
	      '         	 <td style="width:40px; text-align:right"><a type="button" onclick="javascript:eliminaProd('+im.productoid+');" class="btn" style="color:red;margin-left:5px;"><i class="fa fa-trash-o"></i></a> </td>'+
	      '				</tr></table>'+
	      '      	</strong>'+	           
	      '	</div>'+
	      '</div> </div> <hr />';


	      	      
 	     cantProd = cantProd + parseFloat(im.cantidad);
 	     subTotalVenta = subTotalVenta + parseFloat(im.total);
 	     
	}

    $("#detalleProd").html(prodHtmDet);

    $("#cantProdSelVenta").html(cantProd);
	$("#subTotalSelVenta").html(number_format (subTotalVenta, 0, ",", "."));

	/*INI PINTA PAGO EFECTIVO*/
	$("#cantProdSelVentaPE").html(cantProd);
	$("#TotalSelVentaPE").html(number_format (subTotalVenta, 0, ",", "."));
	/*FIN PINTA PAGO EFECTIVO*/
	
	/*INI PINTA VARIABLES FORM*/
	$("#cantidad").val(cantProd);
	$("#total").val(subTotalVenta);
	
	/*FIN PINTA VARIABLES FORM*/
	
	
	
	totalVenta =  parseFloat(subTotalVenta); //el iva ya lo trae calculado
	totalVenta = number_format(totalVenta, 0, ",", ".");
	$("#TotalSelVenta").html(totalVenta);


	//$("#productoFind").focus();
}
function sumarRestaCantidad(tipo,input,productoid,event,otro,stock)
{
	cantidadprod = $("#"+input).val();
	cantidadprodNew = 0;
	if(tipo=="resta" && $("#"+input).val()==1)
	{
		cantidadprodNew = cantidadprod;
	}else{
		cantidadprodNew = parseFloat(cantidadprod) - 1;
	}
	if(tipo=="suma")
	{

		cantidadprodNew = parseFloat(cantidadprod) + 1;
	}
	$("#"+input).val(cantidadprodNew);
	cambiacantProd(productoid,event,otro,stock);
}
function selUltimoIngreso()
{
	for(var l=0;l<ManagerDir.vd.length;l++)
	{
		var im = ManagerDir.vd[l];
	       
		if(im.cursor == 'SI')
	    {
	  	  $("#imp_prod_"+im.productoid).focus();
	  	  $("#imp_prod_"+im.productoid).select();
	    }

	}
}

function doVuelto(e, tipo)
{
	tecla = (document.all) ? e.keyCode : e.which;
	$("#mdg_errorPE").fadeOut('fast');
    if (tecla == 13 || tipo == 'otro'){

    	
    	efectivo = $("#efectivo").val();
    	total = $("#total").val();
    	if(validarSiNumero(efectivo) == "ERROR")
		{
			var errorTitle = "Error- debes revisar lo siguiente.";
			var errores = "<div style=\"width:100%; text-align: left\">Error- Solo se deben ingresar numeros</div>";


			$("#mdg_errorPE_txt").html(errores);
			$("#mdg_errorPE").fadeIn('fast');
			
			$("#efectivo").val("");
			

		}else
		{
			total = parseFloat(total);
			efectivo = parseFloat(efectivo);
			if(total > efectivo)
			{
				
				var errores = "<div style=\"width:100%; text-align: left\">Error- No se puede realizar el pago con un monto menor al total</div>";


				$("#mdg_errorPE_txt").html(errores);
				$("#mdg_errorPE").fadeIn('fast');
				
				

			}else
			{
				vuelto = efectivo - total;
				$("#vuelto").val(number_format (vuelto, 0, ",", "."));

			}

		}
    	
        
    }
}
function cambiacantProd(productoid, e, tipo,stk)
{
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13 || tipo == 'otro'){


    	ncantidad = $("#imp_prod_"+productoid).val();
    	ANTcantidad = $("#ant_imp_prod_"+productoid).val();
    	if(replaceAll(ncantidad," ","") == "")
    	{
    		$("#imp_prod_"+productoid).val(ANTcantidad);
    	}
    	if(ncantidad != ANTcantidad )
    	{

    		if(validarSiNumero(ncantidad) == "ERROR")
    		{
    			var errorTitle = "Error- debes revisar lo siguiente.";
    			var errores = "<div style=\"width:100%; text-align: left\">Solo se deben ingresar numeros</div>";
    			var actionModal = '<button type="button"  class="btn btn-primary"  data-dismiss="modal">Entendido</button>';

    			$("#msgmodal-title").html(errorTitle);
    			$("#msgModal").html(errores);
    			$("#msgmodal-footer").html(actionModal);

    			$('#msgCargaArtefacto').modal('show'); 


    			$("#imp_prod_"+productoid).val(ANTcantidad);

    		}else
    		{
    			ManagerDir.vt = [];
    			 errorCant = 'NO';
    			
    			for(var j=0;j<ManagerDir.vd.length;j++)
    			{	
    		 	       var im = ManagerDir.vd[j];

    		 	       cantN = im.cantidad;
    		 	       
    		 	       if(productoid == im.productoid ){

    					   if(im.tipo_unidad == 'kilos')
    						{
    						   stk = stk*1000;
    						}

    		 	    	   
    		 	    	  if( parseFloat(ncantidad) > parseFloat(stk)  )
    		 	    	  {
        		 	    	  errorCant = 'SI';



        		 	    	  
    		 	    	  }else
    		 	    	  {
        		 	    		cantN = parseFloat(ncantidad);
    		 	    	  }
    		 	       }

    		 
	 			 	 valor_un = im.precio_venta;
			 	    cantN 		= parseFloat(cantN);
			 	    valor_un 	= parseFloat(valor_un);
			 	    var co 		= parseFloat(im.condicion_oferta);

				 	   if(im.precio_oferta != "0" && co > 0 )
				 	    {
					 	    if(cantN < co )
					 	    {
					 	    	tot = valor_un * cantN;
					 	    }else
					 	    {
						 	    var dif = cantN/co;
						 	    var pco = (Math.floor(dif))*co;
						 	    var pso =  cantN - pco; 
	
						 	   tot =  (im.precio_oferta * pco) + (valor_un * pso);
					 	    }
					 	}else
					 	{
					 		valor_un = im.precio_venta;
					 		if(im.precio_oferta != "0")
					 	    {
					 			valor_un = im.precio_oferta;
					 	    }
					 		
					 		tot =  parseFloat(valor_un) * cantN;
						}

				 	   if(im.tipo_unidad == 'kilos')
						{
							tot =  (parseFloat(valor_un)/1000) * parseFloat(cantN);
							
						}

				 		//cuadratura por ley
						var un = tot.toString()[tot.toString().length -1];						
						tot = tot - parseFloat(un);
					
    			 	   var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":cantN,"precio_oferta":im.precio_oferta,"total":tot,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":im.cursor};
    			 	   ManagerDir.vt.push(obj);
    			}

    			ManagerDir.vd = [];
    	        for(var k=0;k<ManagerDir.vt.length;k++){
    	   	        var im = ManagerDir.vt[k];
    	   	        //var obj = {"descripcion":im.descripcion,"archivo":im.archivo,"producto":im.producto,"precio_unitario_con_iva":im.precio_unitario_con_iva,"productoid":im.productoid,"cantidad":im.cantidad,"valor_un":im.valor_un,"total":im.total};
    	   	        var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":im.cantidad,"precio_oferta":im.precio_oferta,"total":im.total,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":im.cursor};
    	            ManagerDir.vd.push(obj);   
    	        }
    	        
    	        pintaDetailProduct();
    	        
    	        if(errorCant == 'SI')
    	        {
        	        
    	        	var errorTitle = "Error- debes revisar lo siguiente.";
        			var errores = "<div style=\"width:100%; text-align: left;color:blue\">No puedes agregar mas de \""+stk+"\" articulo para este producto!!!</div>";
        			var actionModal = '<button onclick="javascript:focusInpCierraModal();" type="button" class="btn btn-primary"  >Entendido</button>';

        			$("#msgmodal-title").html(errorTitle);
        			$("#msgModal").html(errores);
        			$("#msgmodal-footer").html(actionModal);
        			
        			$('#msgCargaArtefacto').modal('show');
    					
    	        }    

    		}


    		

    	}
            
		
    }

}
function eliminaProd(productoid)
{
	ManagerDir.vt = [];
	
	for(var j=0;j<ManagerDir.vd.length;j++)
	{	
 	       var im = ManagerDir.vd[j];
 	       cantN = im.cantidad;
 	       if(productoid != im.productoid ){
 	 	       
 	    	  	
 		 	   valor_un = im.precio_venta;
		 	   /*if(im.precio_oferta != "0")
		 	   {
		 	    	 valor_un = im.precio_oferta;
		 	   }
		 	   tot =  parseFloat(valor_un) * parseFloat(cantN);
				*/

		 	   cantN 		= parseFloat(cantN);
		 	    valor_un 	= parseFloat(valor_un);
		 	    var co 		= parseFloat(im.condicion_oferta);

		 	   if(im.precio_oferta != "0" && co > 0 )
		 	    {
			 	    if(cantN < co )
			 	    {
			 	    	tot = valor_un * cantN;
			 	    }else
			 	    {
				 	    var dif = cantN/co;
				 	    var pco = (Math.floor(dif))*co;
				 	    var pso =  cantN - pco; 

				 	   tot =  (im.precio_oferta * pco) + (valor_un * pso);
			 	    }
			 	}else
			 	{
			 		valor_un = im.precio_venta;
			 		
			 		if(im.precio_oferta != "0")
			 	    {
			 			valor_un = im.precio_oferta;
			 	    }
				 	      
			 		tot =  parseFloat(valor_un) * cantN;
				}

		 	   if(im.tipo_unidad == 'kilos')
				{
					tot =  (parseFloat(valor_un)/1000) * parseFloat(cantN);
					
				}
		 		//cuadratura por ley
				var un = tot.toString()[tot.toString().length -1];
				tot = tot - parseFloat(un);

				
 		 	      
 		 	     //var obj = {"descripcion":im.descripcion,"archivo":im.archivo,"producto":im.producto,"precio_unitario_con_iva":im.precio_unitario_con_iva,"productoid":im.productoid,"cantidad":cantN,"valor_un":valor_un,"total":tot};
 		 	     var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":cantN,"precio_oferta":im.precio_oferta,"total":tot,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":im.cursor};
 		 	     ManagerDir.vt.push(obj);  
 	       }

 	        
	}

	ManagerDir.vd = [];
    for(var k=0;k<ManagerDir.vt.length;k++){
	        var im = ManagerDir.vt[k];
	        //var obj = {"descripcion":im.descripcion,"archivo":im.archivo,"producto":im.producto,"precio_unitario_con_iva":im.precio_unitario_con_iva,"productoid":im.productoid,"cantidad":im.cantidad,"valor_un":im.valor_un,"total":im.total};
	        var obj = {"imagen":im.imagen,"nombre":im.nombre,"precio_venta":im.precio_venta,"productoid":im.productoid,"cantidad":im.cantidad,"precio_oferta":im.precio_oferta,"total":im.total,"codigo":im.codigo,"stock":im.stock,"condicion_oferta":im.condicion_oferta,"tipo_unidad":im.tipo_unidad,"cursor":im.cursor};
        ManagerDir.vd.push(obj);   
    }
    
    pintaDetailProduct();
    $("#productoFind").focus();

}

function AddbuscaProd(pid)
{
	productoFind = $("#productoFind").val(pid);
	buscaProd();
}
function borrarBusqueda()
{
	$("#divBusqueda").fadeOut("fast");
	$("#prodHtmresultado").html("");
}
	

</script>