<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asignarFolioVenta
 *
 * @author omorales
 */
class asignarFolioVenta {
public function insertarFolio($keyClientesInterno,$usuario,$entidad,$f,$basedatos) {




$sSQL333= "SELECT
MAX(contador)+1 as conta
FROM contadorExternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333);


//********YA SE ASIGNO EL FOLIO


if(!$myrow333['conta']){
$myrow333['conta']=1;
}
$FV=$myrow333['conta'];

$sSQLsf= "Select * From contadorExternos WHERE entidad='".$entidad."' and contador='".$FV."'";
$resultsf=mysql_db_query($basedatos,$sSQLsf);
$myrowsf = mysql_fetch_array($resultsf);

if(!$myrowsf['contador']){
     $q4 = "INSERT INTO contadorExternos (contador,usuario,entidad) values ('".$FV."','".$usuario."','".$entidad."')";
mysql_db_query($basedatos,$q4);
echo mysql_error();

return $FV='E'.$FV;
      $qt = "UPDATE clientesInternos set
folioVenta='".$FV."'
WHERE
keyClientesInternos ='".$keyClientesInterno."'
";

mysql_db_query($basedatos,$qt);
echo mysql_error();
return $FV;



}else{
$sSQL333= "SELECT
MAX(contador)+1 as conta
FROM contadorExternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333);


//********YA SE ASIGNO EL FOLIO


if(!$myrow333['conta']){
$myrow333['conta']=1;
}
     $q4 = "INSERT INTO contadorExternos (contador,usuario,entidad) values ('".$FV."','".$usuario."','".$entidad."')";
mysql_db_query($basedatos,$q4);
echo mysql_error();
return $FV=$myrow333['conta'];
}
}
}
?>