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
        		<div class="col-4">
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Productos</h3>
        		</div>
        		
            	<div class="col-8" style="float: right;">
        		 <a  class="btn btn-primary" onclick="abreCrea()" style="float: right;border: 1px solid #b9b9b9;" href="#" data-toggle="modal" data-target="#modal_admin" data-backdrop="static" data-keyboard="false" >+ Crear Producto</a> 
        		</div>
        		<div class="col-12 margin_bottom_10">
        		Se muestran todos los productos configurados en el sistema
        		</div>
               </div>
              <hr />
              <div  class="row" >
	              <div class="col-sm-12"> 
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;width:80px; " >#</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Producto</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Stock</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Venta</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Oferta</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">$ Internet</th>
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        	
					        	$productos = negProducto::getProductos();
					        	foreach ($productos as  $p)
					        	{
					        		if($p["estado"]=="ACTIVO")
					        		{
					        			echo '
											<tr>
								                <td style="text-align:center;width:90px;"><strong>'.$p["posicion"].'</strong><br /><img src="'.$p["imagen"].'" style="max-width:80px; max-height: 80px;" /></td>
								                <td>';
					        			if($p["publicado"]=="SI")
					        			{
					        				echo '<img src="../images/icon_publish.png" style="width:25px;margin-right:5px;margin-bottom: 10px;"  />';
					        			}
					        			echo '
													<strong> <span style="color:#000;font-size: 16px;">'.$p["nombre"].'</span> </strong> #'.$p["tipo"].'<br />
													<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #03374a;margin:1px;"
															type="button" class="btn btn-primary"
															onclick="javascript:editProducto('.$p["productoid"].');"
															data-toggle="modal" data-target="#modal_producto_detalle" data-backdrop="static" data-keyboard="false">Ver Detalle</button>';
					        			if($p["publicado"]=="NO")
					        			{
					        				
					        				echo '<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #47a00c;margin:1px;" type="button" class="btn btn-primary"
																	 onclick="javascript:publicaAnuncio('.$p["productoid"].',\''.number_format($p["precio_venta"],0,',','.').'\',\''.number_format($p["precio_oferta"],0,',','.').'\',\''.number_format($p["precio_internet"],0,',','.').'\',\''.$p["nombre"].'\');"
																	 data-toggle="modal" data-target="#modal_admin_publicar" data-backdrop="static" data-keyboard="false" >Publicar</button>';
					        			}
					        			if($p["publicado"]=="SI")
					        			{
					        				echo '<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #4a0303;border-color: #210101;margin:1px;" type="button" class="btn btn-primary"
																		onclick="javascript:noPublicaAnuncio('.$p["productoid"].',\''.$p["nombre"].'\');"
																		data-toggle="modal" data-target="#modal_admin_nopbl" data-backdrop="static" data-keyboard="false" >No Publicar</button>';
					        			}
					        			
					        			echo '<button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #e21919;border-color: #f00;margin:1px;"
																type="button" class="btn btn-primary"
																data-toggle="modal" data-target="#modal_admin_elimina" data-backdrop="static" data-keyboard="false"
																onclick="javascript:elimnaProducto('.$p["productoid"].',\''.$p["nombre"].'\');">Eliminar</button>
												</td>
					        						
								                <td style="text-align: right;">';
					        			if( $p["stock"] == "0")
					        			{
					        				echo '<strong> <span style="color:#ca4141;font-size: 14px;"><img title="Producto Publicado" src="../images/warning.png " style="width:20px;margin-right:5px;    margin-top: -5px;" />$'.number_format($p["stock"],0,',','.').'</span></strong>';
					        			}else
					        			{
					        				echo '<strong> <span style="color:green;font-size: 14px;">'.number_format($p["stock"],0,',','.').'</span></strong>';
					        			}
					        			
					        			echo '<br /> <button style="float:right; padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #3b6d1a;margin:1px;"
																		type="button" class="btn btn-primary"
																		data-toggle="modal" data-target="#modal_admin_stock" data-backdrop="static" data-keyboard="false"
																		onclick="javascript:adminStock('.$p["productoid"].',\''.number_format($p["stock"],0,',','.').'\',\''.$p["nombre"].'\');">Admin. Stock</button>';
					        			
					        			
					        			
					        			echo
					        			'</td>
												<td style="text-align: right;"><span style="color:#000;font-size: 14px;">$'.number_format($p["precio_venta"],0,',','.').'</span> <br /><span style="color:blue;font-size: 13px;">(x '.$p["tipo_unidad"].')</span></td>
												<td style="text-align: right;"><span style="color:#000;font-size: 14px;">$'.number_format($p["precio_oferta"],0,',','.').'</span></td>
												<td style="text-align: right;">';
					        			
					        			if($p["publicado"]=="SI")
					        			{
					        				echo '<strong> <span style="color:#0130e2;font-size: 14px;"><img title="Producto Publicado" src="../images/ok.png " style="width:25px;margin-right:5px;" />$'.number_format($p["precio_internet"],0,',','.').'</span></strong>';
					        			}else
					        			{
					        				echo '$'.number_format($p["precio_internet"],0,',','.');
					        			}
					        			
					        			echo '
												</td>
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

<?php 

$tipProd = negProducto::getTiposProducto();

?>

<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy">
				
				<form method="post" id="frm_submit" name="frm_submit" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="CREAPROD">
                        <div class="row">
                        	<div class="col-xl-6 col-lg-6  margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span> Tipo</label>
                            	<select  name="tipo" id="tipo" class="name w-100" style="    height: 30px;">
                            		<option value="0">-- SELECCIONE EL TIPO -- </option>
                            		<?php 
                            		
                            			foreach ($tipProd as $tp)
                            			{
                            			    if($tp["estado"] == 'ACTIVO')
                            			    {
                            				  echo '<option value="'.$tp["tipo"].'">'.$tp["tipo"].'</option>';
                            			    }
                            			}
                            		
                            		?>
                            	</select>
                                
                            </div>
                            <div class="col-xl-6 col-lg-6  margin_bottom_10">
								<label for="imagen">Imagen del Producto</label>
								 <input type="file" name="imagen" id="imagen"/>
							</div>
                            <div class="col-xl-8 col-lg-8 margin_bottom_10">
                            	<label style="color: black;><span style="color:red;">*</span> Nombre Prodcuto</label>
                                <input type="text" class="name w-100 contact_info"  name="nombre" id="nombre" placeholder="Ingresa el nombre del prodcuto" >
                            </div>
                             <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label >Codigo del Prodcuto</label>
                                <input type="text" class="name w-100 contact_info"  name="codigo" id="codigo" placeholder="" >
                            </div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >Descripción del Prodcuto</label>
                                <textarea class="name w-100 contact_info" rows="2"  name="descripcion" id="descripcion" placeholder="" ></textarea>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span> Precio Venta  <select id="tipo_unidad" name="tipo_unidad"> <option value="unidad">Unidad</option><option value="kilos">Kilos</option>  </select>  </label>
                                <input type="text" class="name w-100 contact_info"  name="precio_venta" id="precio_venta" placeholder="" >
                            </div>
                             
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label >Precio Internet</label>
                                <input type="text" class="name w-100 contact_info"  name="precio_internet" id="precio_internet" placeholder="" >
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label >Precio Oferta</label>
                                <input type="text" class="name w-100 contact_info"  name="precio_oferta" id="precio_oferta" placeholder="" >
                            </div>
                            
                            <div class="col-xl-8 col-lg-8 margin_bottom_10">
                            	<label >Condición Oferta (Cantidad exacta)</label>
                                <input type="text" class="name w-100 contact_info"  name="condicion_oferta" id="condicion_oferta" placeholder="" >
                                <label style="background-color: #636363;    color: #fff;padding: 5px;">
                                Nota: Si no se indica la cantidad el precio oferta aplica para todos los productos</label>
                            </div>
                            
                            
                        </div>
                        <div id="mensaje_div" class="error-div" style="display: none;">
							
							<div  id="mensaje_login_div_txt">
								
							</div>
										
								<br />
							</div>

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter">
				<div class="row">
					<div id="btns_cprod" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="creaproducto();" style="margin-right: 5px;">Crear Producto</button>
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

<div class="modal fade" id="modal_producto_detalle" tabindex="-1" role="dialog" aria-labelledby="modal_producto_detalle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" > <div id="div_imagen_edit_muestra" style="display: inline;"></div> Detalle del Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_edita">
				
				<form method="post" id="frm_producto_detalle" name="frm_producto_detalle" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="MODIFICAPROD">
                    <input type="hidden" name="productoid_edita" id="productoid_edita" value="0">
                    <input type="hidden" name="nombre_anterior" id="nombre_anterior" value="0">
                    <input type="hidden" name="codigo_anterior" id="codigo_anterior" value="0">
                    <input type="hidden" name="imagen_anterior" id="imagen_anterior" value="0">
                    
                    
                  
                        <div class="row">
                        	
                        	<div class="col-xl-8 col-lg-8  margin_bottom_10">
                        		
                            	<label style="color: black;" ><span style="color:red;">*</span> Tipo</label>
                            	<select  name="tipo_edita" id="tipo_edita" class="name w-100" style="    height: 30px;">
                            		<option value="0">-- SELECCIONE EL TIPO -- </option>
                            		<?php 
                            		
                            			foreach ($tipProd as $tp)
                            			{
                            			    if($tp["estado"] == 'ACTIVO')
                            			    {
                            				  echo '<option value="'.$tp["tipo"].'">'.$tp["tipo"].'</option>';
                            			    }
                            			}
                            		
                            		?>
                            	</select>
                            </div>
                            <div class="col-xl-4 col-lg-4  margin_bottom_10">
                        		
                            	<label style="color: black;" ><span style="color:red;">*</span> Posicion</label>
                            	<select  name="posicion_edita" id="posicion_edita" class="name w-100" style="    height: 30px;">
                            		<?php 
                            		
                            			foreach ($productos as $tp)
                            			{
                            				if($tp["estado"] == 'ACTIVO')
                            				{
                            					echo '<option value="'.$tp["posicion"].'">'.$tp["posicion"].'</option>';
                            				}
                            				
                            			}
                            		
                            		?>
                            	</select>
                                
                            </div>
                            
							
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label style="color: black;><span style="color:red;">*</span> Nombre Prodcuto</label>
                                <input type="text" class="name w-100 contact_info"  name="nombre_edita" id="nombre_edita" placeholder="Ingresa el nombre del prodcuto" >
                            </div>
                             <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label >Codigo del Prodcuto</label>
                                <input type="text" class="name w-100 contact_info"  name="codigo_edita" id="codigo_edita" placeholder="" >
                            </div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >Descripción del Prodcuto</label>
                                <textarea class="name w-100 contact_info" rows="2"  name="descripcion_edita" id="descripcion_edita" placeholder="" ></textarea>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span> Precio Venta  <select id="tipo_unidad_edita" name="tipo_unidad_edita"> <option value="unidad">Unidad</option><option value="kilos">Kilos</option>  </select> </label> 
                                <input type="text" class="name w-100 contact_info"  name="precio_venta_edita" id="precio_venta_edita" placeholder="" >
                            </div>
                             
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label >Precio Internet</label>
                                <input type="text" class="name w-100 contact_info"  name="precio_internet_edita" id="precio_internet_edita" placeholder="" >
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label >Precio Oferta</label>
                                <input type="text" class="name w-100 contact_info"  name="precio_oferta_edita" id="precio_oferta_edita" placeholder="" >
                            </div>
                            <div class="col-xl-8 col-lg-8 margin_bottom_10">
                            	<label >Condición Oferta (Cantidad exacta)</label>
                                <input type="text" class="name w-100 contact_info"  name="condicion_oferta_edita" id="condicion_oferta_edita" placeholder="" >
                                <label style="background-color: #636363;    color: #fff;padding: 5px;">
                                Nota: Si no se indica la cantidad el precio oferta aplica para todos los productos</label>
                            </div>
                            
                            
                            <div class="col-xl-12 col-lg-12  margin_bottom_10"><hr />
								<label for="imagen" style="margin-right: 10px;">Cambiar Imagen </label>
								 <input type="file" name="imagen_edita" id="imagen_edita"/>
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
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="doModificaProducto();" style="margin-right: 5px;">Modificar Producto</button>
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



<div class="modal fade" id="modal_admin_publicar" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Publicar Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_publicar">
				
				<form method="post" id="frm_submit_publicar" name="frm_submit_publicar" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="PUBLICAPRODUCTO">
                    <input type="hidden" name="productoid_publicar" id="productoid_publicar" value="0">
                        <div class="row">
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<strong> <span style="color:#000;font-size: 18px;" id="nom_prod_publica"></span> </strong>
                            </div>
                        	<div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label >Precio Venta</label>
                                <input disabled="disabled" type="text" class="name w-100 contact_info"  name="precio_venta_publicar" id="precio_venta_publicar" placeholder="" >
                            </div>
                             <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label >Precio Oferta</label>
                                <input disabled="disabled" type="text" class="name w-100 contact_info"  name="precio_oferta_publicar" id="precio_oferta_publicar" placeholder="" >
                            </div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span>Para poder publicar el producto enla web debes indicar el "Precio Internet".</label>
                                <input type="text" class="name w-100 contact_info"  name="precio_internet_publicar" id="precio_internet_publicar" placeholder="" onchange="formatNumPublica();" >
                            </div>
                        </div>
                        <div id="mensaje_div_publicar" class="error-div" style="display: none;">
							
							
										
								<br />
							</div>

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter_publicar">
				<div class="row">
					<div id="btns_crea_publicar" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="do_publicaAnuncio();" style="margin-right: 5px;">Publicar</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
				<div class="row">
					<div id="btns_work_publicar"  class="col-xl-12 col-lg-12" style="display: none;">
						En este momento estamos trabajando...
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_admin_nopbl" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Eliminar Publicación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_nopbl">
				
				<form method="post" id="frm_submit_nopbl" name="frm_submit_nopbl" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="ELIMINAPUBLICACIONPRODUCTO">
                    <input type="hidden" name="productoid_nopbl" id="productoid_nopbl" value="0">
                        <div class="row">
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<strong> <span style="color:#000;font-size: 18px;" id="nom_prod_nopbl"></span> </strong>
                            </div>
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">Importante: </span><strong>Al eliminar la publicación el producto NO se vendera desde la pagina web </strong></label>
                                                         </div>
                        </div>
                        <div id="mensaje_div_nopbl" class="error-div" style="display: none;">
							
							
										
								<br />
							</div>

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter_nopbl">
				<div class="row">
					<div id="btns_crea_nopbl" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light"  onclick="do_elimina_publicaAnuncio();" style="margin-right: 5px;background-color: #4a0303;    border-color: #210101;">Eliminar Publicación</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
				<div class="row">
					<div id="btns_work_nopbl"  class="col-xl-12 col-lg-12" style="display: none;">
						En este momento estamos trabajando...
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modal_admin_stock" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Administrar Stock</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_stock">
				
				<form method="post" id="frm_submit_stock" name="frm_submit_stock" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="STOCKADMIN">
                    <input type="hidden" name="stock_action" id="stock_action" value="">
                    <input type="hidden" name="productoid_stock" id="productoid_stock" value="0">
                    <input type="hidden" name="stock_actual_input" id="stock_actual_input" value="0">
                    
                        <div class="row">
                        <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<strong> <span style="color:#000;font-size: 18px;" id="nom_prod_stock"></span> </strong>
                            </div>
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color:#0130e2;font-size: 16px;" ><strong>Stock Actual <span style="padding: 5px;background-color: #d2d2d2;" id="stock_actual"></span></strong> </label>
                            </div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10" id="div_botonera_stock" >
                            	<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="addStockOpen()" style="margin-right: 5px;width: 150px;"> + Agregar Stock</button>
                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light"  onclick="fadeDivs('div_botonera_stock', 'div_elimina_stock','130');" style="margin-right: 5px;width: 150px;">  Eliminar Stock</button>
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-ligh" onclick="muestramovimientosStock();" style="margin-right: 5px;width: 150px;"> Ver Historia</button>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="row" style="padding: 3px;margin: 5px;border: 1px solid #ccc; display: none;" id="div_stock_movimiento">
                        	 <div class="col-xl-8 col-lg-8 margin_bottom_10">
                        		<strong> <span style="color:#000;font-size: 15px; " id="nom_prod_stock" >Detalle de los ultimos 15 movimientos</span> </strong>
							 </div>
							 <div class="col-xl-4 col-lg-4 margin_bottom_10">
							 	 <span  style="float: right;"> <a href="#" onclick="fadeDivs('div_stock_movimiento', 'div_botonera_stock','130');"> [X] </a></span>
                        	 </div>
							 <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<div id="muestra_movimiento_stock">
                            	
                            	</div>
                            </div>
							 
                            
                       </div>
                       
                        
                        <div class="row" style="padding: 3px;margin: 5px;border: 1px solid #ccc; display: none;" id="div_add_stock">
                        	 <div class="col-xl-8 col-lg-8 margin_bottom_10">
                        		<strong> <span style="color:#000;font-size: 15px; " id="nom_prod_stock" >AGREGAR STOCK</span> </strong>
							 </div>
							 <div class="col-xl-4 col-lg-4 margin_bottom_10">
							 	 <span  style="float: right;"> <a href="#" onclick="fadeDivs('div_add_stock', 'div_botonera_stock','130');"> [X] </a></span>
                        	 </div>
							 <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color: black;" >Proveedor</label>
                                <select id="stock_proveedor" name="stock_proveedor">
                                 <option>(Seleccione)</option>
                                 <?php
                                   $proveedores = negProveedor::GetProveedores();
                                   foreach ($proveedores as $pr)
                                   {
                                       echo '<option value="'.$pr["prveedorid"].'">'.$pr["nombre"].'</option>';
                                   }
                                   ?>
                                </select>
                            	</div>
							 <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span>Cantidad</label>
                                <input type="text" class="name w-100 contact_info"  name="stock_add" id="stock_add" placeholder="" onchange="formatNumAll('stock_add');" >
                             </div>
                             <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label style="color: black;" >Valor Unitario</label>
                                <input type="text" class="name w-100 contact_info"  name="stock_valor_unitario" id="stock_valor_unitario" placeholder="" onchange="stockValor('vu');" >
                             </div>
                             <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label style="color: black;" >Valor Total</label>
                                <input type="text" class="name w-100 contact_info"  name="stock_valor_total" id="stock_valor_total" placeholder="" onchange="stockValor('vt');" >
                             </div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10" >
		                        <div id="mensaje_div_addstock" class="error-div" style="display: none;">
								</div>
							</div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10" id="div_botonera_stock_add"  >
                            	<span  style="float: right;"  >
                            	<button type="button" class="btn btn-success btn-sm waves-effect waves-light margin_bottom_10" onclick="do_add_stock();" style="margin-right: 5px;width: 110px;"> + Agregar</button>
                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light margin_bottom_10" onclick="fadeDivs('div_add_stock', 'div_botonera_stock','130');" style="width: 110px;"> Cancelar</button>
                                </span>
                            </div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10"  id="btns_work_stock_add" style="display: none;">
							
								En este momento estamos trabajando...
							</div>
							
                       </div>
                       
                       <div class="row" style="padding: 3px;margin: 5px;border: 1px solid #ccc; display: none;" id="div_elimina_stock">
                        	 <div class="col-xl-8 col-lg-8 margin_bottom_10">
                        		<strong>  <span style="color:red;font-size: 15px; " id="nom_prod_stock" >ELIMINAR STOCK</span> </strong>
							 </div>
							 <div class="col-xl-4 col-lg-4 margin_bottom_10">
							 	 <span  style="float: right;"> <a href="#" onclick="fadeDivs('div_elimina_stock', 'div_botonera_stock','130');"> [X] </a></span>
                        	 </div>
							 <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span>Motivo de la eliminación</label>
                                <input type="text" class="name w-100 contact_info" name="motivo_delete" id="motivo_delete" placeholder="" >
                            </div>
							 <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span>Indica la cantidad a eliminar</label>
                                <input type="text" class="name w-100 contact_info"  name="stock_delete" id="stock_delete" placeholder="" onchange="formatNumAll('stock_add');" >
                            </div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10" >
		                        <div id="mensaje_div_deletestock" class="error-div" style="display: none;">
								</div>
							</div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10" id="div_botonera_stock_delete"  >
                            	<span  style="float: right;"  >
                            	<button type="button" class="btn btn-danger btn-sm waves-effect waves-light margin_bottom_10" onclick="do_delete_stock();" style="margin-right: 5px;width: 110px;"> Eliminar</button>
                                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light margin_bottom_10" onclick="fadeDivs('div_elimina_stock', 'div_botonera_stock','130');" style="width: 110px;"> Cancelar</button>
                                </span>
                          	</div>
                          	 <div class="col-xl-12 col-lg-12 margin_bottom_10"  id="btns_work_stock_delete" style="display: none;">
							
								En este momento estamos trabajando...
							</div>
                       </div>
                       
                       
                        

                    </form>
				
			</div>
			<div class="modal-footer" id="modal_cp_fter_stock">
				<div class="row">
					<div id="btns_crea_stock" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modal_admin_elimina" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Elimina Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy_elimina">
				
				<form method="post" id="frm_submit_elimina" name="frm_submit_elimina" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="ELIMINAPRODUCTO">
                    <input type="hidden" name="productoid_elimina" id="productoid_elimina" value="0">
                    
                        <div class="row">
                        <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<strong> <span style="color:#000;font-size: 18px;" id="nom_prod_elimina"></span> </strong>
                            </div>
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label style="color:#0130e2;font-size: 16px;" ><strong>Importante, si elimina el producto se eliminaran todos los datos, transacciones y la historia asociada al producto!</strong> </label>
                            </div>
                        </div>
                    </form>
			</div>
			<div class="modal-footer" id="modal_cp_fter_elimina">
				<div class="row">
					<div id="btns_crea_elimina" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-danger btn-sm waves-effect waves-light"  onclick="doElimnaProducto();" style="margin-right: 5px;width: 170px;">  Eliminar Producto</button>
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
function elimnaProducto(productoid,prod)
{
	$("#productoid_elimina").val(productoid);
	$("#nom_prod_elimina").html(prod);
}

function doElimnaProducto()
{	
	$("#modal_cp_fter_elimina").html('Estamos trabajando...');
		
	msjError = "No pudimos realizar lo solicitado";
	urlIn = "../c_srv/producto.php";
	formalioID = "frm_submit_elimina";
	srv="ELIMINAPRODUCTO";
	
	setTimeout(function(){

		var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
		
		//OK - Producto eliminado
		$("#modal_cp_bdy_elimina").html("<strong>El stock del producto fue eliminado correctamente!</strong>");
		$("#modal_cp_fter_elimina").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		
	}, 700);
		

	
	
}
function editProducto(productoid)
{
	var sal =  getDataJson("../c_srv/producto.php","acc=GETPRODUCTODETAIL&productoid="+productoid,"GETPRODUCTODETAIL","Error 001","NO");
	var s=sal[0];
	console.log("TIPO:"+s.tipo);
	$("#productoid_edita").val(productoid);
	$("#tipo_edita").val(s.tipo);
	$("#posicion_edita").val(s.posicion);
	$("#nombre_edita").val(s.nombre);
	$("#nombre_anterior").val(s.nombre);
	$("#codigo_anterior").val(s.codigo);
	$("#imagen_anterior").val(s.imagen);
	
	$("#codigo_edita").val(s.codigo);
	$("#descripcion_edita").val(s.descripcion);
	$("#precio_venta_edita").val(s.precio_venta);
	$("#tipo_unidad_edita").val(s.tipo_unidad);
	$("#precio_oferta_edita").val(s.precio_oferta);
	$("#precio_internet_edita").val(s.precio_internet);
	$("#condicion_oferta_edita").val(s.condicion_oferta);

	if(s.imagen != "")
	{
		var htmlV = '<img src="'+s.imagen+'" style="max-width:35px;margin-right:5px;margin-bottom: 10px;"  />';
		$("#div_imagen_edit_muestra").html(htmlV);
	}


	
}
function doModificaProducto()
{


	tipo  					= $("#tipo_edita").val();
	nombre					= $("#nombre_edita").val();
	precio_venta			= $("#precio_venta_edita").val();
	precio_oferta			= $("#precio_oferta_edita").val();
	precio_internet			= $("#precio_internet_edita").val();
	condicion_oferta_edita 	= $("#condicion_oferta_edita").val();

	$("#mensaje_div_edita").html('');
	$("#mensaje_div_edita").fadeOut('fast');

	$("#btns_cprod_edita").fadeOut("fast");
	fadeDivs('btns_cprod_edita', 'btns_work','100');
	
	
	
	
	cerr = 0;
	error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

	if(tipo == 0)
	{
		cerr++;
		error += cerr+'- Debe seleccionar un tipo. <br />';
	}
	if(nombre == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el nombre del producto<br />';
	}
	if(precio_venta == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el precio de venta del producto<br />';
	}else
	{
		if(validarSiNumero(precio_venta) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio de venta solo con números<br />';
		}
	}
	if(precio_oferta != "")
	{
		if(validarSiNumero(precio_oferta) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio oferta solo con números<br />';
		}
	}
	if(condicion_oferta_edita != "")
	{
		if(validarSiNumero(condicion_oferta_edita) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar la condicion de la oferta solo con números<br />';
		}
	}
	if(precio_internet != "")
	{
		if(validarSiNumero(precio_internet) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio de internet solo con números<br />';
		}
	}

	if(cerr>0)
	{
		$("#mensaje_div_edita").html(error);
		$("#mensaje_div_edita").fadeIn('fast');
		fadeDivs('btns_work_edita', 'btns_cprod_edita','800');
		
	}else
	{
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "../c_srv/producto.php";
		formalioID = "frm_producto_detalle";
		srv="MODIFICAPROD";
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				//OK - Producto creado
				$("#modal_cp_bdy_edita").html("<strong>El producto fue modificado correctamente!</strong>");
				$("#modal_cp_fter_edita").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
				
			}else
			{
				//Error - Muestra mensaje
				$("#mensaje_div_edita").html(sal);
				$("#mensaje_div_edita").fadeIn('fast');
				fadeDivs('btns_work_edita', 'btns_cprod_edita','800');				
			}
		}, 700);


		

	}
	
	
}
function muestramovimientosStock()
{

	productoid = $("#productoid_stock").val();
	var html = '<table class="table table-sm" style="">'+
	 '	<tbody>';

	var sal =  getDataJson("../c_srv/producto.php","acc=GETMOVIMIENTOS&productoid="+productoid,"GETMOVIMIENTOS","Error 001","NO");
	html  +='<tr>'+
	'	<td style="color:black;font-size: 13px;"><strong>Fecha</strong></td>'+
	'	<td style="color:black;font-size: 13px;"><strong>Usuario</strong></td>'+
	'	<td style="color:black;font-size: 13px;"><strong>Movimiento</strong></td>'+
	'	<td style="color:black;font-size: 13px;text-align:right;"><strong>Cantidad</strong></td>'+
	
	
	'</tr>';
	
	for(var i=0;i<sal.length;i++)
	{
	  var s=sal[i];

	  var cantidad = '<span style="color:#0130e2;"><strong>'+s.cantidad_format+'</strong></span>';
	  if(s.movimiento=='NEGATIVO')
	  {
		  cantidad = '<span style="color: #ca4141;"><strong>'+s.cantidad_format+'</strong></span>';
	  }
	  
	  html  +=  '<tr>'+
			  	'	<td style="color:black;font-size: 12px;">'+s.fecha_format+'</td>'+
			  	'	<td style="color:black;font-size: 12px;">'+s.nombre_usuario+'</td>'+
				'	<td style="color:black;font-size: 12px;">'+s.movimiento+'</td>'+
				'	<td style="color:black;font-size: 12px;text-align:right;">'+cantidad+'</td>'+
			    '</tr>';
	  
	}
	
		
	html  +='	</tbody>'+
		'</table>';

	fadeDivs('div_botonera_stock', 'div_stock_movimiento','130');
	$("#muestra_movimiento_stock").html(html);
}
function addStockOpen()
{
	 fadeDivs('div_botonera_stock', 'div_add_stock','130');
	 fadeDivs('btns_work_stock_add', 'div_botonera_stock_add','100');
	 $("#mensaje_div_addstock").html('');
	 $("#mensaje_div_addstock").fadeOut('fast');
}
function stockValor(valor)
{
	vu = $("#stock_valor_unitario").val();
	vt = $("#stock_valor_total").val();
	cant = $("#stock_add").val();
	
	
	if(valor == 'vu' )
	{
		if(formatSeparadorMiles(document.getElementById("stock_valor_unitario"))!="ERROR" &&  cant>0)
		{
			vu = replaceAll(vu,'.','');
			cant = replaceAll(cant,'.','');
			vu = parseInt(vu);
			cant = parseInt(cant);

			vt = cant * vu;
			$("#stock_valor_total").val(vt);
			formatNumAll("stock_valor_total");
		}else
		{
			$("#stock_valor_unitario").val("");
			$("#stock_valor_total").val("");
		}
	}
	if(valor == 'vt')
	{
		if(formatSeparadorMiles( document.getElementById("stock_valor_total"))!="ERROR" &&  cant>0)
		{
			vt = replaceAll(vt,'.','');
			cant = replaceAll(cant,'.','');
			vt = parseInt(vt);
			cant = parseInt(cant);

			vu = vt/cant ;
			$("#stock_valor_unitario").val(vu);
			formatNumAll("stock_valor_unitario");
		}else
		{
			$("#stock_valor_unitario").val("");
			$("#stock_valor_total").val("");
		}
	}
}
function adminStock(productoid,stock,prod)
{
	$("#productoid_stock").val(productoid);
	$("#stock_actual").html(stock);
	$("#stock_actual_input").val(stock);
	$("#nom_prod_stock").html(prod);

	$("#div_stock_movimiento").fadeOut('fast');
	$("#div_elimina_stock").fadeOut('fast');
	$("#div_add_stock").fadeOut('fast');
	$("#div_botonera_stock").fadeIn('fast');
	fadeDivs('btns_work_stock_add', 'div_botonera_stock_add','100');

	

}
function do_add_stock()
{
	cant = $("#stock_add").val();
	$("#mensaje_div_addstock").html('');
	$("#mensaje_div_addstock").fadeOut('fast');
	fadeDivs('div_botonera_stock_add', 'btns_work_stock_add','100');

	if(formatSeparadorMiles( document.getElementById("stock_add"))=="ERROR")
	{
		
		$("#stock_add").val("");
		$("#mensaje_div_addstock").html("Solo se aceptan numeros");
		$("#mensaje_div_addstock").fadeIn('fast');
		
		fadeDivs('btns_work_stock_add', 'div_botonera_stock_add','800');
	}else
	{
		cant = parseInt(cant);

		if(cant > 0)
		{
			msjError = "No pudimos realizar lo solicitado";
			urlIn = "../c_srv/producto.php";
			formalioID = "frm_submit_stock";
			srv="STOCKADMIN";
			$("#stock_action").val("ADDSTOCK");
			
			setTimeout(function(){

				var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
				if(sal == "OK")
				{
					//OK - Producto creado
					$("#modal_cp_bdy_stock").html("<strong>El stock del producto fue actualizado correctamente!</strong>");
					$("#modal_cp_fter_stock").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
					
				}else
				{
					//Error - Muestra mensaje
					$("#mensaje_div_addstock").html(sal);
					$("#mensaje_div_addstock").fadeIn('fast');
					fadeDivs('btns_work_stock_add', 'div_botonera_stock_add','800');				
				}
			}, 700);
		}else
		{
			$("#stock_add").val("");
			$("#mensaje_div_addstock").html("Debe indicar una cantidad mayor a 0");
			$("#mensaje_div_addstock").fadeIn('fast');
			fadeDivs('btns_work_stock_add', 'div_botonera_stock_add','800');
		}

		

	}

	
	
}

function do_delete_stock()
{
	cant = $("#stock_delete").val();
	motivo_delete = $("#motivo_delete").val();
	$("#mensaje_div_deletestock").html('');
	$("#mensaje_div_deletestock").fadeOut('fast');
	fadeDivs('div_botonera_stock_delete', 'btns_work_stock_delete','100');

	error = '';
	cerr = 0;


	sa =  $("#stock_actual_input").val();
	sa = replaceAll(sa,'.','');

	if(motivo_delete == "")
	{
		cerr++;
		error += cerr+'- Debe indicar un motivo <br />';
	}

	if(formatSeparadorMiles( document.getElementById("stock_delete"))=="ERROR")
	{
		cerr++;
		error += cerr+'- Solo se aceptan numero <br />';
	}else
	{
		cant = replaceAll(cant,'.','');
		cant = parseInt(cant);
		

		if(cant > 0)
		{

			if(cant > sa)
			{
				cerr++;
				error += cerr+'- No puede eliminar una cantidad mayor al stock actual <br />';
			}
			
		}else
		{
			cerr++;
			error += cerr+'- Debe indicar una cantidad mayor a 0 <br />';
			
		}

	}



	if(cerr > 0)
	{
		$("#stock_delete").val("");
		$("#mensaje_div_deletestock").html(error);
		$("#mensaje_div_deletestock").fadeIn('fast');
		
		fadeDivs('btns_work_stock_delete', 'div_botonera_stock_delete','800');
	}else
	{
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "../c_srv/producto.php";
		formalioID = "frm_submit_stock";
		srv="STOCKADMIN";
		$("#stock_action").val("DELETESTOCK");
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				//OK - Producto creado
				$("#modal_cp_bdy_stock").html("<strong>El stock del producto fue actualizado correctamente!</strong>");
				$("#modal_cp_fter_stock").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
				
			}else
			{
				//Error - Muestra mensaje
				$("#mensaje_div_deletestock").html(sal);
				$("#mensaje_div_deletestock").fadeIn('fast');
				fadeDivs('btns_work_stock_delete', 'div_botonera_stock_delete','800');				
			}
		}, 700);
	}
	
}


function noPublicaAnuncio(productoid,prod)
{
	$("#productoid_nopbl").val(productoid);
	$("#nom_prod_nopbl").html(prod);
	
}
function do_elimina_publicaAnuncio()
{
	msjError = "No pudimos realizar lo solicitado";
	urlIn = "../c_srv/producto.php";
	formalioID = "frm_submit_nopbl";
	srv="ELIMINAPUBLICACIONPRODUCTO";

	
	$("#btns_crea_nopbl").fadeOut("fast");
	fadeDivs('btns_crea_nopbl', 'btns_work_nopbl','100');
	
	setTimeout(function(){

		var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
		if(sal == "OK")
		{
			//OK - Producto creado
			$("#modal_cp_bdy_nopbl").html("<strong>Se ha eliminado la publicación del producto!</strong>");
			$("#modal_cp_fter_nopbl").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
			
		}

		fadeDivs( 'btns_work_nopbl','btns_crea_nopbl','100');
	}, 700);
}
function publicaAnuncio(productoid,pv,po,pi,prod)
{
	$("#productoid_publicar").val(productoid);
	$("#precio_venta_publicar").val(pv);
	$("#precio_oferta_publicar").val(po);
	$("#precio_internet_publicar").val(pi);
	$("#nom_prod_publica").html(prod);
	
}
function formatNumPublica()
{
	formatSeparadorMiles(document.getElementById("precio_internet_publicar"));
}
function formatNumAll(idVal)
{
	formatSeparadorMiles(document.getElementById(idVal));
}
function do_publicaAnuncio()
{
	pi = $("#precio_internet_publicar").val();

	$("#mensaje_div_publicar").html('');
	$("#mensaje_div_publicar").fadeOut('fast');

	$("#btns_crea_publicar").fadeOut("fast");
	fadeDivs('btns_crea_publicar', 'btns_work_publicar','100');
	
	if(formatSeparadorMiles( document.getElementById("precio_internet_publicar"))=="ERROR")
	{
		$("#precio_internet_publicar").val("");
		$("#mensaje_div_publicar").html("Solo se aceptan numeros");
		$("#mensaje_div_publicar").fadeIn('fast');
		fadeDivs('btns_work_publicar', 'btns_crea_publicar','800');
	}else
	{

		pi = parseInt(pi);
		if(pi > 0)
		{
			msjError = "No pudimos realizar lo solicitado";
			urlIn = "../c_srv/producto.php";
			formalioID = "frm_submit_publicar";
			srv="PUBLICAPRODUCTO";
			
			setTimeout(function(){

				var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
				if(sal == "OK")
				{
					//OK - Producto creado
					$("#modal_cp_bdy_publicar").html("<strong>El producto fue publicado correctamente!</strong>");
					$("#modal_cp_fter_publicar").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
					
				}else
				{
					//Error - Muestra mensaje
					$("#mensaje_div_publicar").html(sal);
					$("#mensaje_div_publicar").fadeIn('fast');
					fadeDivs('btns_work_publicar', 'btns_crea_publicar','800');				
				}
			}, 700);
		}else
		{
			$("#precio_internet_publicar").val("");
			$("#mensaje_div_publicar").html("Debe agregar un valor mayor que 0");
			$("#mensaje_div_publicar").fadeIn('fast');
			fadeDivs('btns_work_publicar', 'btns_crea_publicar','800');
		}

		
		

	}
}
function abreCrea()
{
	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	fadeDivs('btns_work', 'btns_cprod','800');

	
	$("#tipo").val('0');
	$("#nombre").val('');
	$("#precio_venta").val('');
	$("#precio_oferta").val('');
	$("#precio_internet").val('');
	$("#codigo").val('');
	$("#descripcion").val('');
}

function creaproducto()
{
	tipo  			= $("#tipo").val();
	nombre			= $("#nombre").val();
	precio_venta	= $("#precio_venta").val();
	precio_oferta	= $("#precio_oferta").val();
	precio_internet	= $("#precio_internet").val();
	condicion_oferta= $("#condicion_oferta").val()

	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	$("#btns_cprod").fadeOut("fast");
	fadeDivs('btns_cprod', 'btns_work','100');
	
	
	
	
	cerr = 0;
	error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

	if(tipo == 0)
	{
		cerr++;
		error += cerr+'- Debe seleccionar un tipo. <br />';
	}
	if(nombre == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el nombre del producto<br />';
	}
	if(precio_venta == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el precio de venta del producto<br />';
	}else
	{
		if(validarSiNumero(precio_venta) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio de venta solo con números<br />';
		}
	}
	if(precio_oferta != "")
	{
		if(validarSiNumero(precio_oferta) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio oferta solo con números<br />';
		}
	}
	if(condicion_oferta != "")
	{
		if(validarSiNumero(condicion_oferta) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar la condición de la oferta solo con números<br />';
		}
	}
	if(precio_internet != "")
	{
		if(validarSiNumero(precio_internet) == "ERROR")
		{
			cerr++;
			error += cerr+'- Debe indicar el precio de internet solo con números<br />';
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
		urlIn = "../c_srv/producto.php";
		formalioID = "frm_submit";
		srv="CREAPROD";
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				//OK - Producto creado
				$("#modal_cp_bdy").html("<strong>El producto fue creado correctamente!</strong>");
				$("#modal_cp_fter").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
				
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
