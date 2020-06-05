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
        			<h3 class="margin_bottom_10 font_size_26 color_000 font_weight_700 text-uppercase">Clientes</h3>
        		</div>
        		
            	<div class="col-8" style="float: right;">
        		 <a  class="btn btn-primary" onclick="abreCrearCliente()" style="float: right;border: 1px solid #b9b9b9;" href="#" data-toggle="modal" data-target="#modal_admin"  >+ Crear Cliente</a> 
        		</div>
        		<div class="col-12 margin_bottom_10">
        		Se muestran todos los clientes configurados en el sistema
        		</div>
               </div>
              <hr />
              <div  class="row" >
	              <div class="col-sm-12"> 
                  
                  <?php
                  $clientes = negCliente::GetClientes();
                  ?>
	                <table id="tabla-lista" class="cell-border" style="width:100%">
					        <thead>
					            <tr>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7">Nombre</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Correo</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Dirección</th>
					                <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Teléfono</th>
                                    <th style="border: 1px solid #949393; background-color: #f7f7f7;border-left: 1px solid #fff;">Acción</th>
                                </tr>
					        </thead>
					        <tbody>
                            <?php 
                              foreach($clientes as $c)
                              {
                                echo '<tr>';
                                echo '<td>'.$c["nombre"].'</td>';
                                echo '<td>'.$c["correo"].'</td>';
                                echo '<td>'.$c["direccion"].'</td>';
                                echo '<td>'.$c["telefono"].'</td>';
                                echo '<td><button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #03374a;margin:1px;" type="button" class="btn btn-primary" onclick="javascript:editAnuncio();">Editar</button><button style="padding: 0px;padding-top: 3px;padding-bottom: 3px;width: 83px;font-size: 12px;background-color: #e21919;border-color: #f00;margin:1px;" type="button" class="btn btn-primary" onclick="eliminarCliente();">Eliminar</button></td>';
                                echo '</tr>';
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

<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="modal_elimina_usuarioLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_cp_bdy">
				
				<form method="post" id="frm_submit" name="frm_submit" enctype='multipart/form-data'>
                    <input type="hidden" name="acc" id="acc" value="CREACLIENTE">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label><span style="color:red;">*</span> Nombre Cliente</label>
                                <input type="text" class="name w-100 contact_info"  name="nombre" id="nombre" placeholder="Ingresa el nombre del cliente" >
                            </div>
                             <div class="col-xl-6 col-lg-6 margin_bottom_10">
                            	<label ><span style="color:red;">*</span>E-mail</label>
                                <input type="text" class="name w-100 contact_info"  name="correo" id="correo" placeholder="" />
                            </div>
                             <div class="col-xl-12 col-lg-12 margin_bottom_10">
                            	<label ><span style="color:red;">*</span> Dirección</label>
                                <input type="text" class="name w-100 contact_info"  name="direccion" id="direccion" placeholder="" />
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 margin_bottom_10">
                            	<label style="color: black"> Teléfono </label>
                                <input type="text" class="name w-100 contact_info"  name="telefono" id="telefono" placeholder="" />
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
					<div id="btns_ccliente" class="col-xl-12 col-lg-12">
						<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="creacliente();" style="margin-right: 5px;">Crear Cliente</button>
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
<script type="text/javascript">

function abreCrearCliente()
{
	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	$("#nombre").val('');
	$("#correo").val('');
	$("#direccion").val('');
	$("#telefono").val('');
}
function eliminarCliente()
{
  /*   $("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

        $("#modal_cp_bdy").html("<strong>¿Está seguro que desea eliminar este cliente?</strong>");
        $("#modal_cp_fter").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
	*/

    $("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	$("#nombre").val('');
	$("#correo").val('');
	$("#direccion").val('');
	$("#telefono").val('');
	
				
}
function creacliente()
{
	nombre      = $("#nombre").val();
	correo		= $("#correo").val();
	direccion	= $("#direccion").val();
	telefono	= $("#telefono").val();


	$("#mensaje_div").html('');
	$("#mensaje_div").fadeOut('fast');

	$("#btns_ccliente").fadeOut("fast");
	fadeDivs('btns_ccliente', 'btns_work','100');
    
	cerr = 0;
	error = '<strong>Error, por favor revise lo siguiente </strong><hr />';

	if(nombre == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el nombre. <br />';
	}
	if(correo == "")
	{
		cerr++;
		error += cerr+'- Debe indicar el e-mail<br />';
	}else{
	   if(validarEmail(correo)== false)
		{
		   cerr++;
			error += cerr+"- Debe ingresar un mail válido<br />";
		}
	}
	if(direccion == "")
	{
		cerr++;
		error += cerr+'- Debe indicar la dirección<br />';
	}
	if(cerr>0)
	{
		$("#mensaje_div").html(error);
		$("#mensaje_div").fadeIn('fast');
		fadeDivs('btns_work', 'btns_ccliente','800');
		
	}else
	{
		msjError = "No pudimos realizar lo solicitado";
		urlIn = "../c_srv/cliente.php";
		formalioID = "frm_submit";
		srv="CREACLIENTE";
		
		setTimeout(function(){

			var sal = getDataJsonSbm(urlIn,formalioID,srv,msjError);
			if(sal == "OK")
			{
				$("#modal_cp_bdy").html("<strong>El cliente fue creado correctamente!</strong>");
				$("#modal_cp_fter").html('<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="reloadLocal();" style="margin-right: 5px;">Entendido</button>');
				
			}else
			{
				//Muestra mensaje
				$("#mensaje_div").html(sal);
				$("#mensaje_div").fadeIn('fast');
				fadeDivs('btns_work', 'btns_ccliente','800');
			}
			
			
		}, 700);


		

	}	
}// fin


</script>
