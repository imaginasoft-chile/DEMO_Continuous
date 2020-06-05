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
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Tipo Producto</h3>
        		</div>
        		
            	<div class="col-8" style="float: right;">
        		 <a  class="btn btn-primary" onclick="abreCrea()" style="float: right;border: 1px solid #b9b9b9;" href="#" data-toggle="modal" data-target="#modal_admin" data-backdrop="static" data-keyboard="false" >+ Crear Tipo Producto</a> 
        		</div>
        		<div class="col-12 margin_bottom_10">
        		Se muestran todos los tipos de producto configurados en el sistema
        		</div>
               </div>
              <hr />
              <div  class="row" >
	              <div class="col-sm-12"> 
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;width:80px; " >#</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Tipo</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Descripción</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Estado</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Acción</th>
					            </tr>
					        </thead>
					        <tbody>
					        
					        <?php 
					        
					        	
					        $productos = negProducto::getTiposProducto();
					        $cont = 0;
					        	foreach ($productos as  $p)
					        	{
					        	    $cont++;
					        	    echo '<tr>';
					        	    echo '<td>'.$cont.'</td>';
					        	    echo '<td>'.$p["tipo"].'</td>';
					        	    echo '<td>'.$p["descripcion"].'</td>';
					        	    echo '<td>'.$p["estado"].'</td>';
					        	    echo '<td><button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #03374a;margin:1px;"
															type="button" class="btn btn-primary"
															onclick="javascript:editProducto(\''.$p["tipo"].'\');"
															data-toggle="modal" data-target="#modal_producto_detalle" data-backdrop="static" data-keyboard="false">Editar</button>';
					        			
					        	    
					        	    echo'</tr>';
					        		
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
				<h5 class="modal-title" id="exampleModalLabel">Crear Tipo Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy">
				
				<form method="post" id="frm_submit" name="frm_submit" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="CREATIPOPROD">
                        <div class="row">
                        	<div class="col-xl-12 col-lg-6  margin_bottom_10">
                            	<label style="color: black;" ><span style="color:red;">*</span> Tipo</label>
                            	<input type="text" class="name w-100 contact_info" value=""  name="tipo" id="tipo" placeholder="Ingresa el nombre del producto" >
                                
                            </div>

                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >Descripción del Producto</label>
                                <textarea class="name w-100 contact_info" rows="2"  name="descripcion" id="descripcion" placeholder="" ></textarea>
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
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="creatipoproducto();" style="margin-right: 5px;">Crear Tipo Producto</button>
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
                    <input type="hidden" name="acc" id="acc" value="MODIFICATIPOPROD">
                    <input type="hidden" name="tipo_ant" id="tipo_ant">


                  
                        <div class="row">
     
							
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label style="color: black;><span style="color:red;">*</span>Tipo</label>
                                <input type="text" class="name w-100 contact_info"  name="tipo_edita" id="tipo_edita" placeholder="Ingresa el tipo de producto" >
                            </div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >Descripción del Producuto</label>
                                <textarea class="name w-100 contact_info" rows="2"  name="descripcion_edita" id="descripcion_edita" placeholder="" ></textarea>
                            </div>
                            <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label >Estado</label>
                                <select id="estado" name="estado">
                                 <option value="ACTIVO">ACTIVO</option>
                                 <option value="INACTIVO">INACTIVO</option>
                                </select>
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
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="doModificaTipoProducto();" style="margin-right: 5px;">Modificar Tipo Producto</button>
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
function editProducto(tipo)
{
	var sal =  getDataJson("../c_srv/producto.php","acc=GETTIPOPRODUCTODETAIL&tipo="+tipo,"GETTIPOPRODUCTODETAIL","Error 001","SI");
	var s=sal[0];
	$("#tipo_edita").val(s.tipo);
	$("#tipo_ant").val(s.tipo);
	$("#estado").val(s.estado);
	$("#descripcion_edita").val(s.descripcion);

}
function doModificaTipoProducto()
{


	tipo  = $("#tipo_edita").val();


	$("#mensaje_div_edita").html('');
	$("#mensaje_div_edita").fadeOut('fast');

	$("#btns_cprod_edita").fadeOut("fast");
	fadeDivs('btns_cprod_edita', 'btns_work','100');
	
	
	
	
	cerr = 0;
	error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

	if(tipo == "")
	{
		cerr++;
		error += cerr+'- Debe ingresar el tipo de producto <br />';
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
		srv="MODIFICATIPOPROD";
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				//OK - Producto creado
				$("#modal_cp_bdy_edita").html("<strong>El tipo de producto fue modificado correctamente!</strong>");
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
function abreCrea()
{
	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	fadeDivs('btns_work', 'btns_cprod','800');

	
	$("#tipo").val('');
	$("#descripcion").val('');
}

function creatipoproducto()
{
	tipo  = $("#tipo").val();
	descripcion  = $("#descripcion").val();

	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	$("#btns_cprod").fadeOut("fast");
	fadeDivs('btns_cprod', 'btns_work','100');
	cerr = 0;
	error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

	if(tipo == "")
	{
		cerr++;
		error += cerr+'- Debe ingresar el tipo de producto. <br />';
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
		srv="CREATIPOPROD";
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				//OK - Producto creado
				$("#modal_cp_bdy").html("<strong>El tipo de producto fue creado correctamente!</strong>");
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
