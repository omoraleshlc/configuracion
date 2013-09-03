<?php 
class ECC{ 
public function estadoCuenta($entidad,$basedatos){
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
                alert("Por Favor, escoje un médico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
                return false   
        }            
}   
</script> 



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
 <h1 align="center" >Estado de Cuenta de Aseguradoras </h1>
 <p>
   <label></label>
 </p>
 <form id="form1" name="form1" method="post" action="">

   <p>&nbsp;</p>
   <table width="691" class="table table-striped">


     <tr >
       <th width="39"  align="center">#  </th>
       <th width="327" >Descripcion</th>
       <th width="111" align="center" >Global</th>
       
       <th width="115" align="center" >Detalles</th>
     
     </tr>
	 
 <?php   
 $sSQL= "Select numCliente,nomCliente From clientes
 where entidad='".$entidad."' AND clientePrincipal='' and
 subCliente=''
 and
 tipoCliente='compania'
  order by nomCliente ASC";
$result=mysql_db_query($basedatos,$sSQL); 



while($myrow = mysql_fetch_array($result)){
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





?>
     <tr >
       <td   align="center"><?php echo $bandera;?></td>
       <td ><?php echo $myrow['nomCliente'];?></td>
       <td  align="center">
	   <a href="#" onClick="javascript:ventanaSecundaria('../../cargos/verSaldos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $N; ?>&amp;numCliente=<?php echo $N?>')">
	   Ver	   </a>	   </td>
       <td  align="center">
	      <a href="#" onClick="javascript:ventanaSecundaria('../../cargos/detallesClientes.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $N; ?>&amp;numCliente=<?php echo $N?>&nombreCliente=<?php echo $myrow['nomCliente'];?>')">
	   Ver 
	   </a>
	   </td>

       
     </tr>
     <?php }?>

   </table>
   <p>&nbsp;</p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>
<?php 
}
} 
?>