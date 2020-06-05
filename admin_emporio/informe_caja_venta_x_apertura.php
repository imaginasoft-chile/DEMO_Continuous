<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<!--  Manejo DataTable FIN -->
<?php 

$cajas  = negCaja::getCajas();
$uCajas = negCaja::getCajasUsuario($_SESSION["usuarioid"]);


if(isset($_REQUEST["cajaid"]))
{
	
	$cajaid=$_REQUEST["cajaid"];
	
}else{
	
		$cont=0;
		foreach ($uCajas as $uc)
		{
			$cont++;
			if($cont == 1)
			{
				$cajaid = $uc["cajaid"];
			}
			
		}
	

}




$cj = negCaja::getCajaDetail($cajaid);



$month = date('m');
$year = date('Y');
$fecha_ini= date('Y/m/d', mktime(0,0,0, $month, 1, $year));
$fecha_ini= date("d/m/Y", strtotime($fecha_ini));

$fecha_fin= date("d/m/Y");

if(isset($_REQUEST["periodo_ini"]))
{
	$fecha_ini_r= $_REQUEST["periodo_ini"];
	$fecha_fin_r= $_REQUEST["periodo_fin"];
	
	if($fecha_ini_r != '')
	{
		$fecha_ini = $fecha_ini_r;
	}
	
	if($fecha_fin_r != '')
	{
		$fecha_fin= $fecha_fin_r;
	}
}

$vaf = explode("/", $fecha_ini);
$fini= $vaf[2]."-".$vaf[1]."-".$vaf[0];

$vaf = explode("/", $fecha_fin);
$ffin = $vaf[2]."-".$vaf[1]."-".$vaf[0];

$vpc = negInforme::informe_ventasPorAperturaPorCaja($cajaid,$fini,$ffin);


?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    $( document ).ready(function() {


    	
    	
    	$("#periodo_ini").datetimepicker({
            format: 'DD/MM/YYYY'
        });
    	$("#periodo_fin").datetimepicker({
            format: 'DD/MM/YYYY'
        });
    	
    	
    });
        

    
      
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChartVentaBarra);

      function drawChartVentaBarra() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha Apertura', 'Ventas']
          <?php 
          foreach ($vpc as $v)
          {
          	echo ",['".$v["dia_abre"]."', ".$v["tot_venta"]."] ";
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Ventas por apertura de caja',
            subtitle: 'Se muestran las ventas por apertura de caja',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
     
		
      
    </script>
    
<div class="row" style="margin-top: -40px;" >
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-12">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Informe de Ventas por apertura de caja</h3>
        		</div>
        		
            	<div class="col-12 margin_bottom_10">
            	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_caja","&cajaid=".$cajaid); ?> "  class="btn_about_us oswald_font">Informe de Ventas</a>
            	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_caja_venta_x_producto","&cajaid=".$cajaid); ?> "  class="btn_about_us oswald_font">Informe de Ventas de Productos</a>
        		
        		
        	
        		</div>
        		
               </div>
               
               
              <hr />
              <div  class="row" >
              <div class="col-4">
              
              <select id="cajaid" name="cajaid" style="font-size: 18px;" onchange="cambiaCaja();">
              <strong>
              
              <?php 
        		
        			$cajas  = negCaja::getCajas();
        			$uCajas = negCaja::getCajasUsuario($_SESSION["usuarioid"]);
        			
        			
        			foreach ($cajas as $c)
        			{
        				$cajaidIn = $c["cajaid"];
        				$estado = $c["estado"];
        				
        				
        				
        				$goCaja =util::creaURLApp(0, "informe_caja","&cajaid=".$cajaidIn);
        				
        				foreach ($uCajas as $uc)
        				{
        					if($cajaidIn == $uc["cajaid"])
        					{
        						$sel = '';
        						if($cajaidIn == $cajaid)
        						{
        							$sel = 'SELECTED="SELECTED"';
        						}
        						
        						echo '<option '.$sel.' value="'.$goCaja.'">'.$c["nombre"].'</option>';		
        						
        					}
        				}
        				
        			}
        				
        		?>
              
              
              	</select>
        		 </strong><br />
        		 
        		 <?php 
        		$tot_venta_all = 0;
        		foreach ($vpc as $v)
        		{
        			
        			$tot_venta_all = (FLOAT)$v["tot_venta"] + (FLOAT)$tot_venta_all;
        		}
        		
        		?>
        		 
        		 
        		Total para el periodo : <span style="color:blue;font-size: 16px;"><strong>$  <?php  echo number_format($tot_venta_all,0,',','.'); ?></strong></span><br />
        	</div>	
        		
        		
        		
        	<div class="col-8">   
        	<form id="info" name="info" action="<?php echo util::creaURLApp(0, "informe_caja_venta_x_apertura","&cajaid=".$cajaid);?>" method="post">
        	
        	

        			<div  class="row" >
		                  <label class="col-sm-3" for="first-name">Fecha Inicio</label>   
		                  <div class="col-sm-3">
		                  <input type="input" id="periodo_ini" value="<?php echo $fecha_ini;?>" style="font-size: 13px;" name="periodo_ini" required="required" class="form-control input-transparent">
		                  </div>
		                  <label class="col-sm-3" for="first-name">Fecha Fin</label>   
		                  <div class="col-sm-3">
		                  <input type=""input"" id="periodo_fin"  value="<?php echo $fecha_fin;?>" style="font-size: 13px;" name="periodo_fin" required="required" class="form-control input-transparent">
		                  </div>
		                  <div class="col-sm-12" >
		                  <button style="font-size: 15px; float: right;" onclick="javascript:generaReporte();" type="button" class="btn btn-success" data-placement="top" data-original-title=".btn .btn-default">Buscar Datos</button>
		                  </div>                 
               		</div>
				</form>  
               </div>
        		</div>
        		
        		
        		
        		  <hr />
              <div  class="row" >
	              	
              		
              
              		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12"> 
              			<div id="columnchart_material" style=" height: 400px;"></div>
              		</div>
              	
              </div>
              
              
              <div  class="row" >
	              <div class="col-sm-12"> 
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7; " >Apertura</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Cierre</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Verndor</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;"># Productos</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Total Vendido</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7; " >Acción</th>
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        foreach ($vpc as $v)
					        {
					        		
					        			
					        			echo '
											<tr>
								                <td style="text-align:left;color:black;"><strong>'.$v["dia_abre"].'</strong></td>
												<td style="text-align:left;color:black;"><strong>'.$v["dia_cierra"].'</strong></td>
												<td style="text-align:left;color:black;"><strong>'.$v["vende"].'</strong></td>
												<td style="text-align: right;"><span style="color:black;font-size: 16px;"><strong>'.number_format($v["tot_productos"],0,',','.').'</strong></span></td>
  												<td style="text-align: right;"><span style="color:blue;font-size: 16px;"><strong>$'.number_format($v["tot_venta"],0,',','.').'</strong></span></td>
												<td style="text-align:center; color:black;"><a style="font-size: 13px;" href="'.util::creaURLApp(0, "informe_detalle_venta","&cajaid=".$cajaid."&param=".$v["accionid"]."&tipo=accion").'"  type="button" class="btn btn-primary" >Ver Detalle</a> </td>
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
function generaReporte()
{

	if($("#periodo_ini") == "" || $("#periodo_fin") == "" )
	{
		alert("Debe indicar las fechas para generar el informe ");
	}else
	{
		document.getElementById("info").submit();
	}
	
}
function cambiaCaja()
{

	goto($("#cajaid").val());

}


</script>