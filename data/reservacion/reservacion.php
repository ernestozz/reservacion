<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

	if(isset($_POST['guardar'])) {
		// guardar:'ok',matriz:matriz,acu_fh:acu_fh,subtotal:lbl_subtotal
		$mat=$_POST['matriz'];		
		$horario=$_POST['horario'];
		$subtotal=$_POST['subtotal'];
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$sericio='';
		$id_ser=$_POST['id_servicio'];
		$tabla='<table class="table table-bordered" border="1" padding="3px" align="center">';
		$tabla=$tabla.'<tr><td>Servicios</td><td>cantidad</td><td>precio</td><td>Total</td></tr>';
		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_SESSION[id]','$id_ser','$subtotal','$fecha','0')");
		for ($i=0; $i < count($mat); $i++) { 
				$ida=$class->idz();
				$a=$mat[$i][1];
				$acus=split(':', $a);
				$servicios=$acus[1];
				$servicios=ltrim($servicios);
				$servicios=preg_replace("/\r\n+|\r+|\n+|\t+/i", " ", $servicios);
				$b=$mat[$i][0];
				$sum=split(':', $b);
				$cantidad=$sum[1];
				$p_cantidad=$acus[2];
				$c=$mat[$i][2];
				$sum1=split(':', $c);
				$t=$sum1[2];
				$tabla=$tabla.'<tr><td>'.$servicios.'</td><td>'.$cantidad.'</td><td>'.$p_cantidad.'</td><td>'.$t.'</td></tr>';

				$res=$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$ida','$id','$servicios','$cantidad','$p_cantidad','$t','$fecha','0')");			
		}		
		$tabla=$tabla.'<tr><td></td><td></td><td>Sub Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td>Iva</td><td>0.00</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td>Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr><td>INICIO H.</td><td>FINAL H.</td><td>FECHA</td><td>DIA</td></tr>';
		for ($i=0; $i <count($horario); $i++) {
			$idb=$class->idz(); 			
			$hi=$horario[$i][0];
			$hf=$horario[$i][1];
			$f=$horario[$i][2];
			$d=$horario[$i][3];
			$tabla=$tabla.'<tr><td>'.$hi.'</td><td>'.$hf.'</td><td>'.$f.'</td><td>'.$d.'</td></tr>';
			$res=$class->consulta("INSERT INTO RESERVACION_HORARIOS VALUES('$idb','$id','$hi','$hf','$f','$d','$fecha','0')");
		}		
		if (!$res) {
			print 1;
		}else print 0;
		// envio del correo a la reservacion
		$tabla=$tabla.'</table>';		
		$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");		
		while ($row=$class->fetch_array($resultado)) {					
			envio_correoReservacion($row['correo'],$tabla);				
	 	}


	}
	if(isset($_POST['obj_tarifa'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T
										WHERE S.ID=T.ID_SERVICIO AND S.ID='$_POST[id]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print $row[0].','.$row[1].',';				
		 	}
	}
	if (isset($_POST['buscar_servicio'])) {
		//$pos=$_POST['pos'];	
		$reg=$_POST['registro'];
		$reg=strtoupper($reg);
		$resultado = $class->consulta("SELECT * FROM servicios WHERE NOM like'%$reg%' AND STADO='1' limit 4 offset 0");

		while ($row=$class->fetch_array($resultado)) {					
			print'<tr><td>'.$row[1].'</td><td>'.substr($row[2],0,10).'...</td><td>'.substr($row[3],0,10).'...</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >						
							<a onclick=btn_select_servicio("'.$row[0].'")  data-dismiss="modal">
							<i class="icon-zoom-in bigger-130 blue pointer icon-animated-bell"></i>
							</a>
					</div>'.'</td></tr>';			
	 	}
	}
	if(isset($_POST['buscar_inf_serv_h'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT DIAS, HORAi, HORAF FROM SERVICIOS S, HORARIO_SERVICIOS H
		WHERE S.ID=H.ID_SERVICIO AND S.ID='$_POST[id]' AND H.STADO ='1'");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print'<tr><td>'.$acu++.'</td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';			
		 	}
	}
	if(isset($_POST['buscar_inf_serv_h2'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T
										WHERE S.ID=T.ID_SERVICIO AND S.ID='$_POST[id]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print'<tr><td>'.$acu++.'</td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';		
		 	}
	}
	if(isset($_POST['buscar_horas'])) {
		$dia=$_POST['dia'];
		$sum=0;
		$a='';
		$resultado = $class->consulta("SELECT horai, horaf, dias FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO ='1';");				
		while ($row=$class->fetch_array($resultado)) {
			$encontrar=1;							
			$acu=split(",", $row[2]);				
			for ($i=0; $i < count($acu); $i++) {
				$dc=strtoupper((String)$acu[$i]);
				if((string)$dc==$dia){						
					$b=split(":", $row[0]);
					$c=split(":", $row[1]);
					$a=$b[0].','.$c[0];
					$sum=1;											
				}
			}		
		}
		if ($sum==1) {
			print($a);
		}else print('n');
	}	
?>