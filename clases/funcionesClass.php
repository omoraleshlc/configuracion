<?php
class validaciones{

public function validaSubModulo($codModulo,$codSM,$usuario,$basedatos){
echo $checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
if($resulScripModulo['codSM']){
return true;
} else {
return false;
}
}


public function ModulosUsuarios1($url,$escape,$raiz,$usuario,$basedatos){
$checaModuloScript= "Select * From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){
echo $url.$escape;
}
}

}
?>