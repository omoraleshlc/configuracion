<?php
class folioVenta{

public function generarFolioVenta($keyClientesInternos,$usuario,$tipoPaciente,$entidad,$tipoFolio,$basedatos){

//INSERT INTO contadorExternos(contador, usuario,entidad)
//SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExternos where entidad='01'), 1)), 'omorales','01'




    switch ($tipoPaciente) {


    case "externo":
    if($keyClientesInternos!=NULL){    
    $q4 = "

    INSERT INTO contadorExternos(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$keyClientesInternos."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT contador as topeMaximo from contadorExternos where keyClientesInternos='".$keyClientesInternos."'    ";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'E'.$myrow['topeMaximo'];
    }else{
        $q4 = "

    INSERT INTO contadorExternos(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$keyClientesInternos."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from contadorExternos where entidad='".$entidad."' and usuario='".$usuario."' order by keyCExt DESC";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'E'.$myrow['topeMaximo'];    
    }
    
    
    break;



//********************************************************************************************************************************
    case "urgencias":

//contador

    $q4 = "
    INSERT INTO contadorInternos(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorInternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'
    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT contador as topeMaximo from contadorInternos where keyClientesInternos='".$keyClientesInternos."'
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'I'.$myrow['topeMaximo'];
//******************************
        break;





    case "interno":

//contador
    
    $q4 = "
    INSERT INTO contadorInternos(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorInternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$keyClientesInternos."'";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "
    SELECT MAX(contador) as topeMaximo from contadorInternos where entidad='".$entidad."' and usuario='".$usuario."' order by keyCInt DESC";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'I'.$myrow['topeMaximo'];
//******************************
        break;

//********************************************************************************************************************************
    case "paquete":
    $q4 = "
    INSERT INTO contadorExternos(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$keyClientesInternos."'";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "
    SELECT contador as topeMaximo from contadorExternos where keyClientesInternos='".$keyClientesInternos."'
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'P'.$myrow['topeMaximo'];
        break;

    
    
    //********************************************************************************************************************************
    case "notaCredito":
    $q4 = "
    INSERT INTO contadorNC(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorNC where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$keyClientesInternos."'";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "
    SELECT MAX(contador) as topeMaximo from contadorNC where entidad='".$entidad."' and usuario='".$usuario."'  order by keyCExt DESC";
    

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'NC'.$myrow['topeMaximo'];
        break;
    
    

    default:
       echo "NO EXISTE";
}



if($keyClientesInternos!=NULL and $keyClientesInternos!=0){
$qt = "UPDATE clientesInternos set
folioVenta='".$FV."'
WHERE
keyClientesInternos ='".$keyClientesInternos."'";
mysql_db_query($basedatos,$qt);
echo mysql_error();
}


return $FV;

}
}

?>