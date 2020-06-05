<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->
<?php 

$cajaid=$_REQUEST["cajaid"];
$accionid=$_REQUEST["accionid"];
$cj = negCaja::getCajaDetail($cajaid);
$rcv = negCaja::getCajaVentaAcumulado($cj[0]["accionid"]);


?>
<iv class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Detalle de Ventas de caja abierta</h3>
        		</div>
        		
            	
        		<div class="col-12 margin_bottom_10">
        		<a style="margin-bottom: 10px;"  href="javascript:backW();" class="btn_about_us oswald_font">Volver</a>
        	
        		</div>
        		<div class="col-12 margin_bottom_10">
        		<strong><?php echo strtoupper($cj[0]["nombre"]);?> </strong><br />
        		VENDEDOR: <span style="color: blue;"><strong> <?php echo strtoupper($cj[0]["nombre_vendedor"]);?> </strong></span><br />
        		FECHA APERTURA: <span style="color: blue;"><strong><?php echo $cj[0]["f_abref"]." ".$cj[0]["f_abreh"];?></strong></span><br />
        		TOTAL VENTAS: <span style="color: blue;"><strong>$<?php echo number_format($rcv[0]["total"],0,',','.');?></strong> </span>
        		</div>
               </div>
               
               
              <hr />
              <div  class="row" >
	              <div class="col-sm-12"> 
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;width:80px; " >Fecha</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Productos</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Tipo Pago</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Total</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Accion</th>
                                </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        	
					        	$ventas = negVenta::getCajaVentaAccionid($accionid);
					        	
					        	foreach ($ventas as  $p)
					        	{
					        		
					        			$cajaventaid= $p["cajaventaid"];
					        			$prodVenta = negVenta::getcajaVentaProductoByCajaventaid($cajaventaid);
					        			
					        	  		
					        		if($p["estado"]!="ANUALDA"){	
					        			echo '
											<tr>
								                <td style="text-align:center;color:black;">'.$p["fecha_venta_format"].'</td>
								              	<td>';
					        			
					        			foreach ($prodVenta as $v)
					        			{
					        				$condO = '';
					        				
					        				if($v["precio_oferta"] > 0)
					        				{
					        					$condO = '[Oferta $'.number_format($v["precio_oferta"],0,",",".");
					        					if($v["condicion_oferta"] >0 )
					        					{
					        						$condO .= ' X '.$v["condicion_oferta"].']';
					        					}else
					        					{
					        						$condO .= ']';
					        					}
					        				}
					        				
					        				
					        				echo ' - <strong><span style="color:#000;font-size: 16px;">'.$v["nombre"].' </span>  $'.number_format($v["precio_venta"],0,",",".").' '.$condO.' | <span style="color:#000;"> Cantidad:'.$v["cantidad"].'</span>  </strong>   <span style="float:right;"><strong> <span style="color:black;">  $'.number_format($v["total"],0,",",".").'<span></strong></span> <br />';
					        			}
					        			
					        			echo '</td>';
					        	
					        			$vch = '';
					        			if($p["voucher_format"] != "")
					        			{
					        				$vch = ' - ['.$p["voucher_format"].']';
					        			}
					        			echo '<td style="text-align:center;color:black;">'.$p["tipo_pago"].''.$vch.'</td>';
					        			
					        			echo '  <td style="text-align: right;"><span style="color:blue;font-size: 16px;"><strong>$'.number_format($p["total"],0,',','.').'</strong></span></td>
                                            
											';
                                            
                                           
                                        echo '<td style="text-align: right;"><span style="color:red;font-size: 16px;"><a type="button" data-toggle="modal" data-target="#modal_producto_detalle" class="btn" href="javascript:anularVenta('.$p["cajaventaid"].');"  style="margin-right: 10px;background-color: #615c5c;" >ANULAR VENTA</a></span></td></tr>' ;
	
					        	   }else{
					        	      		echo '
											<tr>
								                <td style="text-align:center;color:red;">'.$p["fecha_venta_format"].'</td>
								              	<td>';
					        			
					        			foreach ($prodVenta as $v)
					        			{
					        				$condO = '';
					        				
					        				if($v["precio_oferta"] > 0)
					        				{
					        					$condO = '[Oferta $'.number_format($v["precio_oferta"],0,",",".");
					        					if($v["condicion_oferta"] >0 )
					        					{
					        						$condO .= ' X '.$v["condicion_oferta"].']';
					        					}else
					        					{
					        						$condO .= ']';
					        					}
					        				}
					        				
					        				
					        				echo ' - <strong><span style="color:red;font-size: 16px;">'.$v["nombre"].' </span>  $'.number_format($v["precio_venta"],0,",",".").' '.$condO.' | <span style="color:#000;"> Cantidad:'.$v["cantidad"].'</span>  </strong>   <span style="float:right;"><strong> <span style="color:black;">  $'.number_format($v["total"],0,",",".").'<span></strong></span> <br />';
					        			}
					        			
					        			echo '</td>';
					        	
					        			$vch = '';
					        			if($p["voucher_format"] != "")
					        			{
					        				$vch = ' - ['.$p["voucher_format"].']';
					        			}
					        			echo '<td style="text-align:center;color:red;">'.$p["tipo_pago"].''.$vch.'</td>';
					        			
					        			echo '  <td style="text-align: right;"><span style="color:red;font-size: 16px;"><strong>$'.number_format($p["total"],0,',','.').'</strong></span></td>
                                            
											';
                                            
                                           
                                        echo '<td style="text-align: right;"><span style="color:red;font-size: 16px;"><strong>ANULADA</strong></span></td></tr>' ;

					        	   }	
					        		
					        	}
					        	
					        	?>
					        
					            
					           
					        </tbody>
					    </table>
	                </div>
                </div>
                
			</div>
            
	</div>
</div>
<div class="modal fade" id="modal_producto_detalle" tabindex="-1" role="dialog" aria-labelledby="modal_producto_detalle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" > <div id="div_imagen_edit_muestra" style="display: inline;"></div>ANULAR VENTA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_edita">
				
				<form method="post" id="frm_submit_anular" name="frm_submit_anular" enctype='multipart/form-data'>
                    <input type="hidden" name="cajaventaid" id="cajaventaid" value="">
           
                        <div class="row">
                        	
                        	<div class="col-xl-8 col-lg-8  margin_bottom_10">
                        		
                            	<label style="color: black;" ><span style="color:red;"></span>Esta seguro se desea anular esta venta?</label>
                            </div>
       
							
                        </div>
                        <div id="mensaje_div_edita" class="error-div" style="display: none;">
							
							<div  id="mensaje_login_div_txt_edita">
								
							</div>
										
								<br />
							</div>

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter_edita">
				<div class="row">
					<div id="btns_cprod_edita" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="anularVenta();" style="margin-right: 5px;">Anular Venta</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
				<div class="row">
					<div id="btns_work_edita"  class="col-xl-12 col-lg-12" style="display: none;">
						En este momento estamos trabajando...
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
function AnularVenta(cajaventaid){
		
    $("cajaventaid").val(cajaventaid);
}
function doAnularVenta(){
    msjError = "No pudimos realizar lo solicitado";
	urlIn = "../c_srv/venta.php";
	formalioID = "frm_submit_anular";
	srv="ANULARVENTA";
	
	setTimeout(function(){

		var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
		
		//OK - Producto eliminado
		$("#modal_cp_bdy_elimina").html("<strong>El stock del producto fue eliminado correctamente!</strong>");
		$("#modal_cp_fter_elimina").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		
	}, 700);
		

	$("#modal_cp_bdy_elimina").html("<strong>Esta seguro que desea eliminar esta venta?</strong>");
	$("#modal_cp_fter_elimina").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
    
}

</script>