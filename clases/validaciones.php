<?php 
class validaciones{
public function validaModulo($raiz,$secundario,$usuario,$basedatos){
$checaModuloScript= "Select * From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if(!$resulScripModulo['usuario']){
exit;
}
}


public function validaSubModulo($campo,$codModulo,$codSM,$usuario,$basedatos){
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();


//return $resulScripModulo['usuario'];
return $campo= $resulScripModulo['usuario'];;
}
}




?>
