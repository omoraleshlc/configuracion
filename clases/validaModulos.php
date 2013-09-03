<?php 
class validaModulos{

static public function valida($codModulo,$codSM,$usuario,$basedatos){
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
if($resulScripModulo['usuario']){
return true;
} else {
return false;
}
}//cierra funcion
}//cierra clase

$validaModulos=new validaModulos();

if(!$validaModulos->valida($codModulo,$codSM,$usuario,$basedatos)){
echo "Favor de Ingresar Correctamente...!!";
exit;
mysql_close();
}
?>