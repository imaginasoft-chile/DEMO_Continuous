<!--  Manejo DataTable INI -->
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTable/datatables.css"/> 
<script type="text/javascript" src="assets/dataTable/datatables.min.js"></script>

<div class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-sm-6 col-sl-6" style="margin-bottom: 10px;"	>
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Ventas Local</h3>
        			<hr />
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "ventas_local");?>" class="btn_about_us oswald_font"><img src="../images/icon_caja.png" /> Venta Local</a> 
	              	
	              	<?php 
	              	if($_SESSION["IGT-perfil"] == 'admin' )
	              	{
	              	?>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "informes");?>" class="btn_about_us oswald_font"> <img src="../images/icon_grafico.png" />  Informes</a>
	              	<?php 
	              	}
	              	?>
	              	<?php 
	              	if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_admin')
	              	{
	              	?>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "productos");?>" class="btn_about_us oswald_font"> <img src="../images/icon_producto.png" />Productos</a>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "tipo_producto");?>" class="btn_about_us oswald_font"> <img src="../images/icon_producto.png" />Tipo Productos</a>
	              	<?php 
	              	}
	              	?>
	              	<?php 
	              	if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_admin')
	              	{
	              	?>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "gastos");?>" class="btn_about_us oswald_font"> <img src="../images/cash_img.png" style="height: 48px; margin-right:  10px;" />Gastos</a>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "proveedores");?>" class="btn_about_us oswald_font"> <img src="../images/proveedor.png" style="height: 48px; margin-right:  10px;" />Proveedores</a>
	              	<?php 
	              	}
	              	?>
        		</div>
        		<div class="col-sm-6 col-sl-6">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Ventas X Internet</h3>
        			<hr />
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "ventas_internet");?>" class="btn_about_us oswald_font">  <img src="../images/icon_internet.png" /> Venta Internet</a> 
	              	<?php 
	              	if($_SESSION["IGT-perfil"] == 'admin' || $_SESSION["IGT-perfil"] == 'vendedor_internet')
	              	{
	              	?>
	              	<a  style="width: 215px;margin: 10px;" href="<?php echo util::creaURLApp(0, "entregas");?>" class="btn_about_us oswald_font"> <img src="../images/icon_entrega.png" />  Entregas</a>
	              	<?php 
	              	}
	              	?>
        		</div>
               </div>
               <br />
   
   
   <?php 
   
   $vpc = negInforme::informe_ventasPorProductoTop10();
   $vph = negInforme::informe_ventasPorProductoHoy();
   
   ?>
               
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    $( document ).ready(function() {

    	
    	
    	
    });
        

    
      google.charts.load("current", {packages:["corechart"]});

      google.charts.setOnLoadCallback(drawChartVentaPie);
      function drawChartVentaPie() {
        var data = google.visualization.arrayToDataTable([
          ['Producto', 'Cantidad de Ventas']

          <?php 
          
          foreach ($vpc as $v)
          {
          	echo ",['".$v["nombre"]."', ".$v["cantidad"]."] ";
          }
          
          ?>
          
          /*['Work',     11],
          ['Eat',      2]
          */
        ]);

        var options = {
          title: 'Los 10 mas vendidos',
          is3D: true,
          hAxis: {format: 'none'},
          vAxis: {format: 'none'},
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('10prodmv_div'));
        chart.draw(data, options);
      }


      google.charts.setOnLoadCallback(drawProdHoy);
      function drawProdHoy() {
        var data = google.visualization.arrayToDataTable([
          ['Producto', 'Cantidad de Ventas']

          <?php 
          
          foreach ($vph as $v)
          {
          	echo ",['".$v["nombre"]."', ".$v["cantidad"]."] ";
          }
          
          ?>
          
          /*['Work',     11],
          ['Eat',      2]
          */
        ]);

        var options = {
          title: 'Productos vendidos hoy',
          is3D: true,
          hAxis: {format: 'none'},
          vAxis: {format: 'none'},
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('prodmvhoy_div'));
        chart.draw(data, options);
      }
	
    </script>
               
               
               <div  class="row" >
        		<div class="col-sm-12 col-sl-12" style="margin-bottom: 10px;"	>
        			<h3 class="margin_bottom_10 font_size_20 color_000 font_weight_700 text-uppercase">10 Productos mas Vendidos</h3>
        			<hr />
        			<div id="10prodmv_div" style="height: 450px;">
        			</div>
	              	
        		</div>
        		<div class="col-sm-6 col-sl-6">
        			<h3 class="margin_bottom_10 font_size_20 color_000 font_weight_700 text-uppercase">Productos vendidos hoy</h3>
        			<hr />
	              	<div id="prodmvhoy_div" style="height: 400px;">
        			</div>
        		</div>
        		<div class="col-sm-6 col-sl-6">
        			<h3 class="margin_bottom_10 font_size_20 color_000 font_weight_700 text-uppercase">Productos con poco Stock</h3>
        			<hr />
	              	
	              	<?php 
	              		$pps = negInforme::informe_prodPocoStock(10);
	              	?>
	              	<table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7; " >Producto</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Cantidad stock</th>
					                
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        foreach ($pps as $v)
					        {
					        		
					        			
					        			echo '
											<tr>
								                <td style="text-align:left;color:black;"><strong>'.$v["nombre"].'</strong></td>
												<td style="text-align: right;"><span style="color:black;font-size: 16px;"><strong>'.number_format($v["stock"],0,',','.').'</strong></span></td>
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