<?php
if(!isset($_SESSION))
{
	session_start();		
}

require('../../admin/class.php');
$class=new constante();
//obtencion d campos usuario y password
$usu=$_POST['u'];
$pass=$_POST['p'];
$existencia=0;

$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE correo='$usu' and pass=md5('$pass') and stado='1'");	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			//Dando valor a variables de session
			$_SESSION['id'] = $row[0];
			$_SESSION['nom'] = $row[2];
			$_SESSION['usu'] = $row[5];
			$_SESSION['pass'] = $row[6];


			//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
			$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
			                                                    "','SELECT','".
			                                                    $_SESSION['id'].
			                                                    "','SEG.USUARIO','TODOS','".$_SESSION['id']."','".
			                                                    $class->fecha_hora().
			                                                    "','INICIO SESSION')");
	}

$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE correo='$usu' and pass=md5('$pass') and stado='0'");
//md5('$pass' || 'SALT2 %&/323* *')	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=2;						
}


print($existencia);

?>