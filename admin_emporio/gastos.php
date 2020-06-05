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
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Gastos</h3>
        		</div>
        		
            	<div class="col-8" style="float: right;">
        		  
        		</div>
        		<div class="col-12 margin_bottom_10">
        		Modulo que permite agregar gastos
        		</div>
               </div>
              <hr />
              <div  class="row" >
	              <div class="col-sm-12">
		              <div >
							<div >
								
								<div>
									
									<form method="post" id="frm_submit" name="frm_submit" enctype='multipart/form-data'>
					                    <input type="hidden" name="acc" id="acc" value="ADDGASTO">
					                        <div class="row">
					                        	<div class="col-xl-4 col-lg-4  margin_bottom_10">
					                            	<label style="color: black;" ><span style="color:red;">*</span> TIPO DE GASTO</label>
					                            	<select  name="tipo" id="tipo" class="name w-100" style="    height: 30px;">
					                            		<option value="0">-- SELECCIONE EL TIPO -- </option>
					                            		<?php 
					                            			
					                            			$gastoTipo = negGasto::getGastoTipo();
					                            			foreach ($gastoTipo as $tp)
					                            			{
					                            				
					                            				echo '<option value="'.$tp["tipogastoid"].'">'.$tp["tipogastoid"].'</option>';
					                            				
					                            			}
					                            		
					                            		?>
					                            	</select>
					                                
					                            </div>
					                            <div class="col-xl-8 col-lg-8  margin_bottom_10">
													<label style="color: black;><span style="color:red;">*</span> BENEFICIARIO (Nombre persona o institución de destino) </label>
					                                <input type="text" class="name w-100 contact_info"  name="beneficiario" id="beneficiario" placeholder="Ingresa el nombre del beneficiario" >
												</div>
					                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
					                            	<label >Nota del gasto</label>
					                                <textarea class="name w-100 contact_info" rows="2"  name="nota" id="nota" placeholder="" ></textarea>
					                            </div>
					                            
					                            <div class="col-xl-4 col-lg-4 margin_bottom_10">
					                            	<label style="color: black;" ><span style="color:red;">*</span> $Monto del gasto</label>
					                                <input type="text" class="name w-100 contact_info"  name="monto_gasto" id="monto_gasto" placeholder="" >
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
											<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="creaGasto();" style="margin-right: 5px;" href="#" data-toggle="modal" data-target="#modal_crea_gasto" data-backdrop="static" data-keyboard="false">Agregar Gasto</button>
											<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" onclick="cancelarGasto()">Cancelar</button>
										</div>
									</div>
									
								</div>
							</div>
						</div> 
	                
	                </div>
                </div>
                
			</div>
		</div>
	</div>
</div>

<?php 

$tipProd = negProducto::getTiposProducto();

?>


<div class="modal fade" id="modal_crea_gasto" tabindex="-1" role="dialog" aria-labelledby="modal_modal_crea_gasto" aria-hidden="true">
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
                        	<div class="col-xl-12 col-lg-12 margin_bottom_10" id="msg-div">
                            	<label style="color:#0130e2;font-size: 16px;" ><strong>En este momento estamos agregando el gasto...</strong> </label>
                            </div>
                        </div>
                    </form>
			</div>
			<div class="modal-footer" id="modal_cp_fter_elimina">
				<div class="row">
					<div id="btns_crea_gasto_ok" class="col-xl-12 col-lg-12" style="display: none;">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light"  onclick="reloadLocal();" style="margin-right: 5px;width: 170px;">  Entendido</button>						
					</div>
					
					<div id="btns_error_bt" class="col-xl-12 col-lg-12" style="display: none;">
						<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Entendido</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

function cancelarGasto()
{
	$("#tipo").val("0");
	$("#beneficiario").val("");
	$("#nota").val("");
	$("#monto_gasto").val("");
}

function creaGasto()
{
	$("#btns_error_bt").fadeOut("fast");
	$("#btns_crea_gasto_ok").fadeOut("fast");
	
	tipo 		 = $("#tipo").val();
	beneficiario = $("#beneficiario").val();
	monto 		 = $("#monto_gasto").val();


	
	
	if(formatSeparadorMiles( document.getElementById("monto_gasto"))=="ERROR")
	{		
		$("#monto_gasto").val("");
		$("#msg-div").html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong>Solo debes ingresar números  en el monto del gasto.</div>');
		$("#btns_error_bt").fadeIn("fast");		
		
	}else
	{
		if(tipo == "0")
		{
			$("#monto_gasto").val("");
			$("#msg-div").html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Debe seleccionar un tipo de gasto.</div>');
			$("#btns_error_bt").fadeIn("fast");
		}else
		{
			if(beneficiario == "")
			{
				$("#monto_gasto").val("");
				$("#msg-div").html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Debe indicar el nombre del Beneficiario.</div>');
				$("#btns_error_bt").fadeIn("fast");
			}else
			{
				if(monto == "")
				{
					$("#monto_gasto").val("");
					$("#msg-div").html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Debe indicar el monto del gasto.</div>');
					$("#btns_error_bt").fadeIn("fast");
				}else
				{
					$("#msg-div").html('<div class="alert alert-info" role="alert">  <strong>Trabajando</strong> En este momento estamos generando el gasto, por favor espere... </div>');

					msjError = "No pudimos realizar lo solicitado";
					urlIn = "../c_srv/gasto.php";
					formalioID = "frm_submit";
					srv="ADDGASTO";					
					
					setTimeout(function(){

						var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
							//OK - Producto creado
						$("#msg-div").html('<div class="alert alert-success" role="alert">  <strong>Realizado</strong> El gasto fue agregado correctamente! </div>');
						$("#btns_crea_gasto_ok").fadeIn('fast');
							
						
					}, 700);					
					
				}
			}	
		}
	}	
}

</script>
