<?php class listadoClientes{
public function listaClientes($tipoconvenio,$entidad,$ventana,$ventana1,$TITULO,$basedatos){




if(!$_POST['nuevo'] and ($_GET['borrar']=='si' AND $_GET['numCliente'])){
$borrame = "DELETE FROM convenios WHERE entidad='".$entidad."' AND numCliente ='".$_GET['numCliente']."' and tipoConvenio='".$_GET['tipoConvenio']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo 'Se elimino el convenio '.$_GET['tipoConvenio'];

}

?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=550,height=400,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  


<?php 
$ventanaCentro=new ventanasCentro();
$ventanaCentro->despliegaVentanaCentro('blue','0.5','800','600','800','400','800','500');
?>



<?php 
if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numCliente']!=$myrow1['numCliente']){
$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,entidad
) values ('".$_POST['numCliente']."','".$_POST['nomCliente']."',
'".$usuario."','".$fecha1."','".$_POST['nivel']."','".$_POST['ID_AUXILIAR']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE DIO DE ALTA AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
} else {
echo $q = "UPDATE clientes set 
nomCliente='".$_POST['nomCliente']."',
nivel='".$_POST['nivel']."',
ID_AUXILIAR='".$_POST['ID_AUXILIAR']."',
usuario='".$usuario."',
fecha='".$fecha1."'
WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
}}


if($_POST['nuevo']){
/** checo si existe**/
$_POST['numCliente'] = "";
}


if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>


 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo= new muestraEstilos();
$estilo->styles();

?>

</head>

<body onLoad="inicio();">
 <h1 align="center" ><?php echo $TITULO;  ?></h1>

  <form id="form1" name="form1" method="post" action="">

   <table width="750" class="table table-striped">
 
     <tr >
       <th width="17" align="center" >#</th>
       <th width="198" >Cliente</th>
       
       <th width="54" align="center" >Tipo Px</th>
       <th width="103" align="center" >Editar/Ver</th>
       <th width="49" align="center" >Agregar</th>
       <th width="150" align="center" >Eliminar Convenio</th>
     </tr>
<?php


switch ($tipoconvenio) {
    case "cantidad":
    $sSQL= "Select * From convenios,clientes where convenios.entidad='".$entidad."'
 AND
 convenios.tipoConvenio='cantidad'
 AND
 clientes.numCliente=convenios.numCliente
 group by convenios.numCliente
order by clientes.nomCliente ASC
 ";
        break;
    case "grupoProducto":
            $sSQL= "Select * From convenios,clientes where convenios.entidad='".$entidad."'
 AND
 convenios.tipoConvenio='grupoProducto'
 AND
 clientes.numCliente=convenios.numCliente
 group by convenios.numCliente
order by clientes.nomCliente ASC
 ";
        break;
    case "global":
            $sSQL= "Select * From convenios,clientes where convenios.entidad='".$entidad."'
 AND
 convenios.tipoConvenio='global'
 AND
 clientes.numCliente=convenios.numCliente
 group by convenios.numCliente
order by clientes.nomCliente ASC
 ";
        break;


        case "precioEspecial":
            $sSQL= "Select * From convenios,clientes where convenios.entidad='".$entidad."'
 AND
 convenios.tipoConvenio='precioEspecial'
 AND
 clientes.numCliente=convenios.numCliente
 group by convenios.numCliente
order by clientes.nomCliente ASC
 ";
        break;

        case "descuentoConvenio":
            $sSQL= "Select * From convenios,clientes where convenios.entidad='".$entidad."'
 AND
 convenios.tipoConvenio='descuentoConvenio'
 AND
 clientes.numCliente=convenios.numCliente
 group by convenios.numCliente
order by clientes.nomCliente ASC
 ";
        break;
}




 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
$N=$myrow['numCliente'];


$sSQL1= "Select nomCliente From clientes where entidad='".$entidad."'
 AND
numCliente='".$myrow['clientePrincipal']."'";



$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
     
      <tr >



          <td  ><?php
          echo $a;
          ?></td>





          


          <td  ><?php 
          if($myrow['nomCliente']!=NULL){
          echo $myrow['nomCliente'];
          }else{
              echo '<span class="error">El cliente/aseguradora ya no existe,  favor de eliminar el convenio!</span>';
          }
          ?><br />



          <td  ><?php
          if($myrow['tipo']!=NULL){
          echo $myrow['tipo'];
          }else{
              echo '<span class="error">Sin tipo de clientes!</span>';
          }
          ?><br />





       <td  align="center"><a href="#" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Lista de convenios de: '.$myrow['nomCliente'];?></div>')"
                                           onmouseout="UnTip()" onClick="ventanaSecundaria2('<?php echo $ventana1;?>?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>')"> Editar Convenios</a></td>
       <td  align="center">
           <span >
               <a href="#" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar al cliente: '.$myrow['nomCliente'];?></div>')"
                                                                 onmouseout="UnTip()" onClick="ventanaSecundaria2('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">Agregar</a></span></td>




          <td  ><p align="center">
<a href="<?php echo $url;?>?numCliente=<?php echo $N; ?>&tipoConvenio=<?php echo $tipoconvenio;?>&borrar=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">

<img src="/sima/imagenes/borrar.png" alt="INACTIVO" width="20" height="20" border="0"
     onclick="if(confirm('Esta seguro que deseas eliminar el convenio <?php echo $tipoconvenio;?> del cliente <?php   echo $myrow1['nomCliente'];?> ?') == false){return false;}" />
</a></p>
       </td>

      </tr><?php }?>




   </table>

<p>&nbsp;</p>
   <p>
     <input name="nuevo" type="submit"  id="nuevo" value="Nuevo Cliente"
	  onclick="ventanaSecundaria2('<?php echo $ventana;?>')" />
   </p>
</form>
 <br></br>
 <br></br>
</body>
</html>
<?php
}
}
?>