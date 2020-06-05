<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>

<div class="row" style="margin-top: -40px;">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 news_box first_news_box">
        	<div>
        		<div  class="row" >
        		<div class="col-sm-12 col-sl-12" style="margin-bottom: 10px;"	>
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Informes</h3>
        			<hr />
        		</div>
        		<div class="col-sm-12 col-sl-12">
        		
        			<div id="accordion">
  <h3>Informe de Ventas</h3>
  <div>
    <p>
    	El informe de Ventas muestra el detalle de las ventas por día por un periodo de tiempo, este informe es por Caja y el periodo es seleccionable. 
    </p>
    <p>
    	    <a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_caja",""); ?> "  class="btn_about_us oswald_font">Ver el Informe de Ventas</a>
    </p>
    
  </div>
  <h3>Informe de Ventas por apertura de caja</h3>
  <div>
    <p>
    Este Informe muestra el detalle de las ventas por apertura de caja, se muestra la fecha de apertura y cierre de la caja y quien fue el vendedor que trabajo durante la apertura de la caja-
    </p>
    <p>
    	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_caja_venta_x_apertura",""); ?> "  class="btn_about_us oswald_font">Informe de Ventas por apertura de caja</a>
    </p>
  </div>
  <h3>Informe de Ventas de Productos</h3>
  <div>
    <p>
    	Este informe muestra el detalle de las ventas por productos en un periodo seleccionable.
    </p>
    <p>
    	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_caja_venta_x_producto",""); ?> "  class="btn_about_us oswald_font">Informe de Ventas de Productos</a>
    </p>
  
  </div>
  <h3>Informe contable de Compra y Venta</h3>
  <div>
    <p>
   	 Este informe obtiene las compras y ventas durante un periodo de tiempo
    </p>
    <p>
    	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_compra_venta_total",""); ?> "  class="btn_about_us oswald_font">Informe compra venta</a>
    </p>
  </div>
  <h3>Informe de gastos</h3>
  <div>
    <p>
   	 Este informe obtiene el detalle de los gastos
    </p>
    <p>
    	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_gastos",""); ?> "  class="btn_about_us oswald_font">Informe de gastos</a>
    </p>
  </div>
  <h3>Informe por Familia</h3>
  <div>
    <p>
   	 Este informe obtiene las comprar por tipo de producto durante un periodo de tiempo
    </p>
    <p>
    	<a style="margin-bottom: 10px;"  href="<?php echo util::creaURLApp(0, "informe_familia",""); ?> "  class="btn_about_us oswald_font">Informe por Familia</a>
    </p>
  </div>
</div>
	              	
	              	
        		</div>
               </div>
                
			</div>
		</div>
	</div>
</div>