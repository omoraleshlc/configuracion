<?php $llavePrimaria = session_id(); session_start();?><?php require("baseDatos.php"); ?><?php require('/configuracion/clases/valida.php');?>
<?php 
$db_conn=validator::conectaOracle($db_conecta);
$hora1=validator::hora1();
$fecha1=validator::fecha1();
$dia=validator::dia();
$basedatos=MYSQL::basedatos();
$conecta=MYSQL::conecta();
$validaOracle=new validator();
$validaOracle2=new validator();
$validaSesiones=new validator();

/* $ip=new resuelveIP();
$ip=$ip->ip();  */
$ip = $_SERVER['REMOTE_ADDR']; 
validator::javascript();
$ID_EJERCICIOM=validator::ejercicio($ID_EJERCICIOM1,$basedatos,$db_conn);

		
			if(validator::sesionesActivas($usuario,$llavePrimaria,$basedatos)){
			
 
			$usuario=validator::sesionesActivas($usuario,$llavePrimaria,$basedatos); 
			
			
			
			
			} else { 
			
$usuario=$validaOracle->validaOracle($ip,$_POST['username'],$_POST['password'],$_POST['ingresar'],$basedatos,$ID_EJERCICIOM,$dia,$hora1,$fecha1,$db_conn);
			
				if(!$usuario){			
					$validaSesiones->validaSession();
					
					}  
				
}
	

print muestraSesion::sesionActiva($usuario,$basedatos,$ALMACEN);	
$MEDICO=validator::medico($usuario,$basedatos);
$entidad=new validator();
$entidad=$entidad->entidad($usuario,$basedatos);
$tipoUsuario=validator::tipoUsuario($usuario,$basedatos);



/*
function Remove_SQLi($str) 
{ 
   $connection_string = mysql_connect('server', 'database_user','user_password');  
   if(get_magic_quotes_gpc()) 
   { 
       return mysql_real_escape_string(stripslashes($str), $connection_string); 
   } 
   else       
       return mysql_real_escape_string($str, $connection_string); 
}*/
?>