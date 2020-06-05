<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->
<?php 

$cajaid=$_REQUEST["cajaid"];
$tipo= $_REQUEST["tipo"];
$param= $_REQUEST["param"];


$cj = negCaja::getCajaDetail($cajaid);


if($tipo == "dia")
{
	$vaf = explode("/", $param);
	$dia= $vaf[2]."-".$vaf[1]."-".$vaf[0];
	$vpc = negInforme::informe_CajaVentaXDia($cajaid,$param);
	
}
if($tipo == "accion")
{
	$vpc= negVenta::getCajaVentaAccionid($param);
}



?>
<iv class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Detalle de Ventas</h3>
        		</div>
        		
            	
        		<div class="col-12 margin_bottom_10">
        		<a style="margin-bottom: 10px;"  href="javascript:backW();" class="btn_about_us oswald_font">Volver</a>
        	
        		</div>
        		<div class="col-12 margin_bottom_10">
        		<?php 
        		$tot_venta_all = 0;
        		foreach ($vpc as $v)
        		{
        			
        			$tot_venta_all = (FLOAT)$v["total"] + (FLOAT)$tot_venta_all;
        		}
        		
        		?>
        		
        		<strong><?php echo strtoupper($cj[0]["nombre"]);?> </strong><br />
        		
        		TOTAL VENTAS: <span style="color: blue;"><strong>$<?php echo number_format($tot_venta_all,0,',','.');?></strong> </span>
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
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        	
					        	
					        	foreach ($vpc as  $p)
					        	{
					        		
					        			$cajaventaid= $p["cajaventaid"];
					        			$prodVenta = negVenta::getcajaVentaProductoByCajaventaid($cajaventaid);
					        			
					        			
					        			
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
								            </tr>
											';
					        	
					        		
					        			
					        		
					        		
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





<script type="text/javascript">


</script>