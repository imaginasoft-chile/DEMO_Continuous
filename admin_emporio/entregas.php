<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->

<iv class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Entregas Pendientes</h3>
        		</div>
        		
            	
        		<div class="col-12 margin_bottom_10">
        		
        		</div>
               </div>
              <hr />
              <div  class="row" >
	              <div class="col-sm-12"> 
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;width:80px; " >#</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Productos</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Cliente</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Venta</th>
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        	
					        	$ventas = negVenta::getVentasPendientesInternet();
					        	$cont  = 0;
					        	foreach ($ventas as  $p)
					        	{
					        		if($p["estado"] == 'DESPACHADA' )
					        		{
					        			$cont ++;
					        			$ventaid = $p["ventaid"];
					        			$prodVenta = negVenta::getVentasProductos($ventaid);
					        			
					        			$estado = '<span style="color:#000;font-size: 16px;">'.$p["estado"].'</span>';
					        			$btn = '';
					        			$stl_row='';
					        			
					        			
					        			if($p["estado"] == 'DESPACHADA')
					        			{
					        				$estado = '<span style="color:red;font-size: 16px;">'.$p["estado"].'</span>';
					        				$btn = '<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 120px;font-size: 12px;background-color: #47a00c;margin:1px;" type="button" class="btn btn-primary"
															type="button" class="btn btn-success"
															onclick="javascript:despachaProdOpen('.$ventaid.');"
															data-toggle="modal" data-target="#modal_entrega" data-backdrop="static" data-keyboard="false">Entregar Venta</button>
        				
											  <button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 120px;font-size: 12px;background-color: #e21919;border-color: #f00;margin:1px;"
																type="button" class="btn btn-primary"
																data-toggle="modal" data-target="#modal_cancelar" data-backdrop="static" data-keyboard="false"
																onclick="javascript:cancelaVentaOpen('.$ventaid.');">Cancelar Despacho</button>';
					        				
					        			}
					        			
					        			
					        			echo '
											<tr '.$stl_row.' >
								                <td style="text-align:center;color:black;"><strong>'.$cont.'<br />'.$estado.'<br />'.$p["fecha_format"].'</strong></td>
								              	<td>';
					        			
					        			foreach ($prodVenta as $v)
					        			{
					        				$productoid = $v["productoid"];
					        				$dp = negProducto::getProductoDetail($productoid);
					        				$vtp = (FLOAT)$dp[0]["precio_internet"] * (FLOAT)$v["cantidad"];
					        				
					        				echo ' - <strong><span style="color:#000;font-size: 16px;">[#'.$v["cantidad"].'] '.$dp[0]["nombre"].' </span>  $'.number_format($dp[0]["precio_internet"],0,",",".").' </strong>  - '.$dp[0]["tipo"].'  <span style="float:right;"><strong> <span style="color:black;">  $'.number_format($vtp,0,",",".").'<span></strong></span> <br />';
					        			}
					        			echo $btn;
					        			echo '</td>';
					        			
					        			echo '<td>
														<strong>	 <span style="color:#000;font-size: 16px;">'.$p["nombre"].'</span> </strong>
													<br /> <span style="color:#a90202;font-size: 16px;">- '.$p["direccion"].'</span>
													<br /> - <span style="color:#127ae8;font-size: 16px;">'.$p["telefono"].' | '.$p["correo"].'</span>
												 </td>';
					        			
					        			echo '  <td style="text-align: right;"><span style="color:black;font-size: 16px;"><strong>$'.number_format($p["valor_total"],0,',','.').'</strong></span></td>
								            </tr>
											';
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
</div>


<div class="modal fade" id="modal_entrega" tabindex="-1" role="dialog" aria-labelledby="modal_despacha_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Entregar Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_despacha">
				
				<form method="post" id="frm_submit_despacha" name="frm_submit_despacha" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="ENTREGAVENTA">
                    <input type="hidden" name="ventaid" id="ventaid" value="0">
                    
                        <div class="row">
                        <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<strong> <span style="color:#000;font-size: 18px;" id="nom_prod_despacha"></span> </strong>
                            </div>
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color:#000;font-size: 16px;" ><strong>Ya realizó la entrega de la venta?</strong> </label>
                            </div>
                        </div>
                    </form>
			</div>
			<div class="modal-footer" id="modal_cp_fter_despacha">
				<div class="row">
					<div id="btns_crea_despacha" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light"  onclick="doEntregaVenta();" style="margin-right: 5px;">Si, ya se realizó la entrega</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modal_cancelar" tabindex="-1" role="dialog" aria-labelledby="modal_cancelar_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cancelar Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_cancelar">
				
				<form method="post" id="frm_submit_cancelar" name="frm_submit_cancelar" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="CANCELARVENTADESPACHO">
                    <input type="hidden" name="ventaidcancela" id="ventaidcancela" value="0">
                    
                        <div class="row">
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color:#000;font-size: 16px;" ><strong>Esta seguro que quiere cancelar la venta?</strong> </label>
                            </div>
                        </div>
                    </form>
			</div>
			<div class="modal-footer" id="modal_cp_fter_cancelar">
				<div class="row">
					<div id="btns_crea_cancelar" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-danger btn-sm waves-effect waves-light"  onclick="docancelarVenta();" style="margin-right: 5px;width: 170px;">Si, cancelar Venta</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

function cancelaVentaOpen(ventaid)
{
	$("#ventaidcancela").val(ventaid);
	
}
function docancelarVenta()
{
	$("#modal_cp_fter_cancelar").html('Estamos trabajando...');
	
	msjError = "No pudimos realizar lo solicitado";
	urlIn = "../c_srv/venta.php";
	formalioID = "frm_submit_cancelar";
	srv="CANCELARVENTADESPACHO";
	
	setTimeout(function(){

		var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
		
		//OK - Producto eliminado
		$("#modal_cp_bdy_cancelar").html("<strong>La venta fue cancelada correctamente!</strong>");
		$("#modal_cp_fter_cancelar").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		
	}, 200);
}
function despachaProdOpen(ventaid)
{
	$("#ventaid").val(ventaid);
	
}
function doEntregaVenta()
{
	$("#modal_cp_fter_despacha").html('Estamos trabajando...');
	
	msjError = "No pudimos realizar lo solicitado";
	urlIn = "../c_srv/venta.php";
	formalioID = "frm_submit_despacha";
	srv="ENTREGAVENTA";
	
	setTimeout(function(){

		var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
		
		//OK - Producto eliminado
		$("#modal_cp_bdy_despacha").html("<strong>La venta fue despachada correctamente!</strong>");
		$("#modal_cp_fter_despacha").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		
	}, 200);
}

</script>