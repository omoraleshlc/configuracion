<?php require("/configuracion/baseDatos.php"); 
$usuario=NULL;
$fecha=NULL;
$hora=NULL;
$nivel1=NULL;
$nivel3=NULL;
$porcentajePS=NULL;
$keyPA=NULL;
$basedatos=MYSQL::basedatos();
$conecta=MYSQL::conecta();



function roundTo($number, $to){
    return round($number/$to, 0)* $to;
} 


//TODAS LAS ENTIDADSEs
$sSQL0= "SELECT
* 
FROM 
entidades
 
";

$result0=mysql_db_query($basedatos,$sSQL0);
while($myrow0 = mysql_fetch_array($result0)){
    $entidad=$myrow0['codigoEntidad'];

    
    
    
//TODOS articulos en request
 $sSQL1= "SELECT
* 
FROM 
precioArticulos
where
entidad='".$entidad."'
   and
    status='request'

";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){
$codigo+=1;
$a+=1;


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

//QUIERO SABER EL GRUPO
$sSQL1a= "SELECT
* 
FROM 
articulos
where
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."'
";

$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
$grupo=$myrow1a['gpoProducto'];

$sSQL1act= "SELECT
* 
FROM 
gpoProductos
where

codigoGP='".$grupo."'
";

$result1act=mysql_db_query($basedatos,$sSQL1act);
$myrow1act = mysql_fetch_array($result1act);

//SI TRAE PRECIO SUGERIDO LO RESPETO
if( $myrow1act['afectaPS']=='si' and $myrow1['precioSugerido']>0  ){


$sSQL7a= "Select * From articulosPrecioNivel where entidad='".$entidad."' 
and
codigo='".$myrow1['codigo']."'
";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
while($myrow7a = mysql_fetch_array($result7a)){
    
    //actualizar todo************************************


$porcentajePS=1-round(($myrow7a['nivel1']/$myrow7a['nivel3']),2);
$nivel1=$myrow1['precioSugerido'];
$nivel3=$nivel1+($nivel1*$porcentajePS);


$agrega = "UPDATE precioArticulos set
status='final'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
and
status='request'
order by  keyC DESC
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$nivel1."','".$nivel3."', '".$id_medico[$i]."','".$_GET['keyPA']."','".$myrow7a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$agrega1 = "UPDATE articulosPrecioNivel set
nivel1='".$nivel1."',
    nivel3='".$nivel3."'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."' 
and
almacen='".$myrow7a['almacen']."'
";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
//****************************************************
}



}else{ //NO TRAE PRECIO SUGERIDO
    

//verificar si tiene politicas de precio
$sSQL1b= "SELECT
* 
FROM 
politicasPrecios
where 
entidad='".$entidad."'    
and
gpoProducto='".$grupo."' 
";

$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);






if( $myrow1b['rangoInicial']>0){
//AHORA ME TRAIGO EL CODIGO QUE ESTA EN LOS ALMACENES

    $sSQL7a= "Select * From articulosPrecioNivel where entidad='".$entidad."' 
and
codigo='".$myrow1['codigo']."'

";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
while($myrow7a = mysql_fetch_array($result7a)){
    

    
    


$sSQL1bd= "SELECT
* 
FROM 
politicasPrecios
where 
entidad='".$entidad."'    
and
gpoProducto='".$grupo."' 
    and
     '".$myrow1['costo']."' 
         between rangoInicial and rangoFinal
        
";

$result1bd=mysql_db_query($basedatos,$sSQL1bd);
$myrow1bd = mysql_fetch_array($result1bd);
    

    
    //actualizar todo************************************
    if($myrow1bd['porcentaje']>0 and $myrow1['costo']>0){



        
        
$porcentajePS=1-round(($myrow7a['nivel1']/$myrow7a['nivel3']),2);
$nivel1=($myrow1['costo']+($myrow1['costo']*$myrow1bd['porcentaje'])/100);
$nivel3=$nivel1+($nivel1*$porcentajePS);


$agrega = "UPDATE precioArticulos set
status='final'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
and
status='request'
order by  keyC DESC
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow7a['codigo']."','','',
    '".round($nivel1)."','".round($nivel3)."', '','".$myrow7a['keyPA']."','".$myrow7a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$agrega1 = "UPDATE articulosPrecioNivel set
nivel1='".round($nivel1)."',
    nivel3='".($nivel3)."'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."' 
and
almacen='".$myrow7a['almacen']."'
";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
//****************************************************
}
}  
}



}//no trae precio sugerido
}
}
?>