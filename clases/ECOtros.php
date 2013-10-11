<?php class Otros {
public function estadoCuenta($fecha1,$entidad,$basedatos){
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript>
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=400,height=400,scrollbars=YES") 
} 
</script> 


<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")   
                return false   
        }            
}   
</script> 


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();

?>

</head>

<body>
 <h1 align="center" class="titulos">Estado de Cuenta Otros </h1>
 <p>
   <label></label>
 </p>
 <form id="form1" name="form1" method="post" action="">

   <p align="center" >Periodo</p>
   <p align="center" >Fecha Inicial
     <label>
       <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
       </label>
       <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
       <label></label>
     a la fecha
  <label>
  <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
  </label>
  <input name="button2" type="image"src="/sima/imagenes/btns/fecha.png" />
  <label> <br />
  <br />
  <input name="buscar" type="submit"  id="search" value="Buscar" />
  </label>
   </p>
   <p>&nbsp;</p>
   
   <?php if($_POST['buscar']){ ?>
   <table width="691" class="table table-striped">


     <tr >
          <th width="5"  align="left">#</th>
          <th width="5"  align="left">#Sis</th>
         <th width="30"  align="left">FolioVenta<br>Recibo</th>
         <th width="30"  align="left">Fecha<br>Aplicacion</th>
         <th width="30"  align="left">Fecha<br>Cierre</th>
       <th width="30"  align="left">Vigencia</th>
       <th width="316" align="left">Responsable</th>
       <th width="50" align="left" >Cargos</th>

        <th width="50" align="left" >Abonos</th>
       
     </tr>
	 
     
     
     
     
     
<?php      
//**********************ABONOS DE ASEGURADORA***************
$sSQL1a="SELECT sum(precioVenta*cantidad)  as abonos

FROM  
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$_GET['numCliente']."'
and
(tipoTransaccion='devxaseg' or tipoTransaccion='abaseg')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$_POST['fechaInicial']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow24['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$fecha1."'

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);     
     
?>     
     
     
     
     
 <?php   
$sSQL= "Select * From cargosCuentaPaciente
 where entidad='".$entidad."' AND 
fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."'
and
(
tipoTransaccion='abotros' or
tipoTransaccion='totros' or 
tipoTransaccion='devotr' or 
tipoTransaccion='AJOXINCDEV' or
tipoTransaccion='devotr' or 
tipoTransaccion='HLCAJOTR' or
tipoTransaccion='devtotros'
)
and
(folioVenta!='' or folioVentaOtros!='')
order by fecha1 ASC

 ";
$result=mysql_db_query($basedatos,$sSQL); 



while($myrow = mysql_fetch_array($result)){

if($myrow['folioVenta']!='' or $myrow['folioVentaOtros']!=''){  
    
    
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$N=$myrow['numCliente'];




$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}



 
 
 
if($myrow['folioVentaOtros']!=NULL){
      $sSQLcp="SELECT paciente
FROM
clientesInternos
WHERE
entidad='".$entidad."'
and

folioVenta='".$myrow['folioVentaOtros']."'
 
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);  
$myrow['folioVenta']=$myrow['folioVentaOtros'];
}else{
  $sSQLcp="SELECT paciente
FROM
clientesInternos
WHERE
entidad='".$entidad."'
and

folioVenta='".$myrow['folioVenta']."'
 
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);    
}
?>
     <tr  >
          <td   align="left"><?php echo $bandera;?></td>
 
          
                <td   align="left">
          
 <?php   

    echo $myrow['keyCAP'];

           
           ?></td>
       

          
          
          
      <td   align="left">
           <?php 
         
if($myrow['tipoTransaccion']=='HLCAJOTR' or $myrow['tipoTransaccion']=='abotros' or $myrow['tipoTransaccion']=='devtotros' ){
           echo $myrow['numRecibo'];    
           }else{
           echo $myrow['folioVenta'];        
           }
           
           
           ?></td>          
          
          
          
          
          <td align="left">
<?php            if($myrow['fecha1']!=NULL){
               echo cambia_a_normal($myrow['fecha1']);
           }else{
               echo '---';
           }
?>           
           </td>          
          
          
          
          
          <td align="left">
<?php            if($myrow['fechaCierre']!=NULL){
               echo cambia_a_normal($myrow['fechaCierre']);
           }else{
               echo '---';
           }
?>           
           </td>
          
          
          
          
          
          
          
          
          
          
          
       
       <td align="left">
<?php            if($myrow['fechaVencimiento']!=NULL){
               echo cambia_a_normal($myrow['fechaVencimiento']);
           }else{
               echo '---';
           }
?>           
           </td>
       
       
       <td align="left"><?php echo $myrowcp['paciente'];?></br>
<a href="#" onClick="javascript:ventanaSecundaria('../cargos/detallesOtros.php?fechaInicial=<?php echo $_POST['fechaInicial']; ?>&fechaFinal=<?php echo $_POST['fechaFinal']; ?>&folioVenta=<?php echo $myrow['folioVenta']; ?>&paciente=<?php echo $myrowcp['paciente'];?>')">
E Cuenta	        
           <?php 
           echo '<br>';
           echo $myrow['tipoTransaccion'];

           
           ?><br />
     </a></td>
          
          
          
<td  align="left">

    
	   <?php //DEBE
           //echo $myrow['tipoTransaccion'];
           if( $myrow['tipoTransaccion']=='totros' or $myrow['tipoTransaccion']=='devotr' or $myrow['tipoTransaccion']=='AJOXINCDEV'){ 
           $d=$myrow['precioVenta']*$myrow['cantidad'];  
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
	   $dt[0]+=$myrow['precioVenta']*$myrow['cantidad'];
	   }else{
               //echo '$ 0.00';
           }
           
           ?>    
	   

</td>
          
          
          
       

          
          
<td  align="left">
<?php 


if($myrow['tipoTransaccion']=='HLCAJOTR' or $myrow['tipoTransaccion']=='abotros' or $myrow['tipoTransaccion']=='devtotros' ){ 


$h=$myrow['precioVenta']*$myrow['cantidad'];
$ht[0]+=$myrow['precioVenta']*$myrow['cantidad'];$signo=NULL;
echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
}else{
   //echo '$ 0.00';
}
           

?></td>






       
          
          
          
          
          
          
          
          
          
          
          
          
          
          
     </tr>
<?php }}?>

       <tr>
        <td class="notice">Totales</td>
          <td width="100">&nbsp;</td>
       <td width="100">&nbsp;</td>
      
        <td width="100">&nbsp;</td>
       <td width="100">&nbsp;</td>
       <td  width="100">&nbsp;</td>
             <td width="100">&nbsp;</td>
       <td  width="100">
           <?php echo '$'.number_format($dt[0],2);?>
       </td>
             
             
       <td width="100"><div align="center" >
           <?php echo '$'.number_format($ht[0],2);?>
           </div>
       </td>
             
       <td width="100"><div align="center" ><?php echo '$'.number_format($dt[0]-$ht[0],2);?></div></td>
     </tr>


     
     
     
     
  	 
   </table>
   <p>&nbsp;</p>
   <?php } ?>
 </form>
 <p align="center">&nbsp;</p>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 

<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
</body>
</html>
<?php 
}
}
?>