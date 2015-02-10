<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../inicio');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />

		<!--basic styles-->

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="../assets/css/fontdc.css" />		
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
		
		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />





		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />




		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php  menu(); ?>

			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
								<div class="widget-box light-border">
									<div class="widget-header header-color-dark">
										<h5 class="smaller">Información Bancos</h5>

										<div class="widget-toolbar">
											<span class="badge badge-important">Bancos</span>
										</div>
									</div>
									<div class="widget-body">
									<!-- contenido -->
										<div class="widget-main padding-6">
											<div class="widget-box">
												<div class="widget-header">
													<h5 class="smaller">Tabbed</h5>

													<div class="widget-toolbar no-border">
														<ul class="nav nav-tabs" id="myTab">
															<li class="active">
																<a data-toggle="tab" href="#bancos">Bancos</a>
															</li>

															<li>
																<a data-toggle="tab" href="#cuentas">Cuentas</a>
															</li>
														</ul>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="tab-content">
															<div id="bancos" class="tab-pane in active">
																<table id="tbl_bancos" class="table table-striped table-bordered table-hover">
																	<thead>
																		<tr>
																			<td width="10px"><div class="icon-align-justify"></div></td>																			
																			<td class="center"><div class="icon-university"></div> Banco</td>
																			<td width="150px"class="center"><div class="icon-cogs"></div> Fecha</td>
																			<td class="center"><div class="icon-cogs"></div> Estado</td>
																			<td class="center"><div class="icon-cogs"></div> Accion</td>
																		</tr>
																	</thead>
																	<tbody>
																	</tbody>
																</table>
															</div>

															<div id="cuentas" class="tab-pane">														
																<table id="tbl_cuentas" class="table table-striped table-bordered table-hover">
																	<thead>
																		<tr>
																			<td width="10px"><div class="icon-align-justify"></div></td>																			
																			<td class="center"><div class="icon-university"></div> Banco</td>
																			<td width="150px"class="center"><div class="icon-university"></div> Cuenta</td>
																			<td width="150px"class="center"><div class="icon-university"></div> Tipo</td>
																			<td width="150px"class="center"><div class="icon-cogs"></div> Fecha</td>
																			<td width="100px"class="center"><div class="icon-cogs"></div> Estado</td>
																			<td width="100px"class="center"><div class="icon-cogs"></div> Accion</td>
																		</tr>
																	</thead>
																	<tbody>
																	</tbody>
																</table>															
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<!-- fin contenido -->
									</div>
								</div>
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div>
				</div>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>


		<div id="modal-nuevo_banco" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Registro nuevo Banco
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-main" id="obj_contenedor">
						<form class="form-horizontal" id="form_n_bancos"/>
							<div class="row-fluid">
								<div class="span8">	
									<div class="control-group">
										<label class="control-label" for="name">Banco:</label>
										<div class="controls">
											<span class="span12">
												<input class="span12" type="text" id="txt_n_banco" name="txt_n_banco" />
											</span>
										</div>									
									</div>
									<div class="controls">
										<button class="btn btn-small btn-success" type="submit">
											<i class="icon-save"></i>
											Guardar
										</button>
									</div>	
								</div>
							</div>
						</form>
					</div>					
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-rigth" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
																	
			</div>
		</div>
		<div id="modal-nuevo_cuenta" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Registro nueva cuenta
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-main" id="obj_contenedor">
						<form class="form-horizontal" id="form_n_cuentas"/>
							<div class="row-fluid">
								<div class="span8" >
									<div class="control-group">
										<label class="control-label" for="name">Banco:</label>
										<div class="controls">
											<span class="span12">
												<select class="chosen-select form-control" id="sel_n_banco" name="sel_n_banco">
													
													
												</select>
											</span>
										</div>									
									</div>
									<div class="control-group">
										<label class="control-label" for="name">Cuenta:</label>
										<div class="controls">
											<span class="span12">
												<input class="span12" type="text" id="txt_n_cuentas" name="txt_n_cuentas" />
											</span>
										</div>									
									</div>
									<div class="control-group">
										<label class="control-label" for="name">Tipo:</label>
										<div class="controls">
											<span class="span12">
												<select id="sel_tipo_cuenta" name="sel_tipo_cuenta">
													<option value> Seleccione tipo Cuenta</option>
													<option value="CORRIENTE">CORRIENTE</option>
													<option value="AHORROS">AHORROS</option>
												</select>
											</span>
										</div>									
									</div>
									<div class="controls">
										<button class="btn btn-small btn-success" type="submit">
											<i class="icon-save"></i>
											Guardar
										</button>
									</div>	
								</div>
							</div>
						</form>
					</div>					
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-rigth" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
																	
			</div>
		</div>

		<!--basic scripts

		<!--[if !IE]>-->

		

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/markdown/markdown.min.js"></script>
		<script src="../assets/js/markdown/bootstrap-markdown.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>	
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/chosen.jquery.min.js"></script>

		

		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="index.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">
		$(function(){			
			// $("#sel_banco_cuenta").css({'width':'50px'}).chosen();
			
		});

		</script>

	</body>
</html>