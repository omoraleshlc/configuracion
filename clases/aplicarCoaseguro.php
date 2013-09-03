<?php 
class aplicarCoaseguro{
public function coaseguro($ALMACEN,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){


$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$cargosCia=new acumulados();

$UserType=new tipoUsuario();
$UserType=$UserType->tipoDeUsuario($usuario,$basedatos,$ALMACEN);
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
  
  
  
  
</script> 

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>



 <?php

if($_POST['aplicar']  ){

//*********************** coaseguro 1**********************************
$sSQL31= "Select * From avisos WHERE entidad='".$entidad."' AND numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$myrow31['statusAviso']){
$agrega = "INSERT INTO avisos (
numeroE,nCuenta,tipoAviso,usuario,fecha,hora,statusAviso,keyCI,
porcentajeDeducible1,
porcentajeCoaseguro1,
porcentajeDeducible2,
porcentajeCoaseguro2,
importeDeducible1,
importeCoaseguro1,
importeDeducible2,
importeCoaseguro2,
entidad
) 
values 
('".$numeroE."','".$nCuenta."','caja',
'".$usuario."','".$fecha1."','".$hora1."','standby','".$_GET['nT']."',
'".$_POST['porcentajeDeducible1']."',
'".$_POST['porcentajeCoaseguro1']."',
'".$_POST['porcentajeDeducible2']."',
'".$_POST['porcentajeCoaseguro2']."',

'".$_POST['importeDeducible1']."',
'".$_POST['importeCoaseguro1']."',
'".$_POST['importeDeducible2']."',
'".$_POST['importeCoaseguro2']."',
'".$entidad."'
)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda= "Se solicit&oacute; la transacci&oacute;n de cargo de Coaseguro a Paciente";

}else{
$agrega = "UPDATE avisos set 
porcentajeDeducible1='".$_POST['porcentajeDeducible1']."',
porcentajeCoaseguro1='".$_POST['porcentajeCoaseguro1']."',
porcentajeDeducible2='".$_POST['porcentajeDeducible2']."',
porcentajeCoaseguro2='".$_POST['porcentajeCoaseguro2']."',

importeDeducible1='".$_POST['importeDeducible1']."',
importeCoaseguro1='".$_POST['importeCoaseguro1']."',
importeDeducible2='".$_POST['importeDeducible2']."',
importeCoaseguro2='".$_POST['importeCoaseguro2']."'

where
entidad='".$entidad."' AND
numeroE='".$numeroE."' AND
nCuenta='".$nCuenta."'

";

//mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda= "Se actualizaron registros";
}//********************************CIERRA COASEGURO 1



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>




<BODY >

<h1 align="center"> Coaseguro / Deducible</h1>
<form id="form1" name="form1" method="post" action="">
  <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="549" height="24" />
  <table width="549" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#990099" class="none">
    <tr>
      <th bgcolor="#CCCCCC" class="none" scope="col"><div align="left">N&uacute;mero de Transacci&oacute;n: </div></th>
      <th bgcolor="#CCCCCC" class="none" scope="col"><div align="left"><?php 
		 echo $myrow3['folioVenta'];
		 $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="134" bgcolor="#CCCCCC" class="Estilo24" scope="col">
      <div align="left" class="none"><strong>Paciente: </strong></div></th>
      <th width="408" bgcolor="#CCCCCC" class="Estilo24" scope="col">
      <div align="left"><strong>
      
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="none">Compa&ntilde;&iacute;a: </td>
<td bgcolor="#CCCCCC" class="none"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="none">N&deg; Credencial: </td>
      <td bgcolor="#CCCCCC" class="Estilo24"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" alt="bo1" width="549" height="24" />
<p>&nbsp;</p>
  <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="723" height="24" />
  <table width="723" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="60" class="style14" scope="col"><div align="left" class="none">#Movto.</div></th>
      <th width="112" height="14" class="style14" scope="col"><div align="left" class="none">Fecha/Hora</div></th>
      <th width="270" class="style14" scope="col"><div align="left" class="none">Descripci&oacute;n/Concepto</div></th>
      <th width="44" class="style14" scope="col"><div align="left" class="none">Status</div></th>
      <th width="33" class="style14" scope="col"><div align="left" class="none">Cant</div></th>
      <th width="61" class="style14" scope="col"><div align="left" class="none">Importe</div></th>
      <th width="40" class="style14" scope="col"><div align="left" class="none">IVA</div></th>
      <th width="69" class="style14" scope="col"><div align="left" class="none">Natura</div></th>
    </tr>
    <tr>
      
      <?php //traigo agregados
	  $mostrarIVA=new articulosDetalles();$status=new acumulados();$importe=new acumulados();

$sSQL81= "
SELECT *
FROM
cargosCuentaPaciente 
 WHERE 
 folioVenta='".$_GET['folioVenta']."'
and
statusCargo!='cancelado'

 
  order by fecha1,hora1 asc
";






$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];






?>



<td bgcolor="<?php echo $color;?>" class="codigos"><?php echo $myrow81['keyCAP'];?></span></td>
	
      <td height="21" bgcolor="<?php echo $color;?>" class="normal">
	  <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><span class="style12"><span class="style7">
      <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
      </span></span>        <span class="style12">
		
        <?php  if($myrow81['um']=='s' or $myrow81['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>

      </span> </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 

echo $status->status($keyCAP,$basedatos,$usuario,$numeroE,$nCuenta);
	?></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center" class="normal">
          <?php  
	

		
		echo $cantidad=$myrow81['cantidad'];
			
		

		
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="precionormal1" align="right">
      
	  <?php 
	 echo "$".number_format($myrow81['precioVenta'],2);
	 if($myrow81['naturaleza']=='C' or $myrow81['naturaleza']=='coaseguro'){
 $cargos[0]+=($myrow81['precioVenta']*$myrow81['cantidad']);
		} else if($myrow81['naturaleza']=='A'){
	$abonos[0]+=($myrow81['precioVenta']*$myrow81['cantidad']);
		}
		?>
      </span></span></span></td>
      <td bgcolor="<?php echo $color;?>" class="precionormal2" align="right">
	  
        <?php 
		echo "$".number_format($myrow81['iva'],2);
		if($myrow81['tipoCliente']=='aseguradora' or $myrow81['naturaleza']=='coaseguro'){
		 $SUMAIVA[0]+=($myrow81['iva']*$myrow81['cantidad']);
		 }
		?>
      </span></span></span></td>
      <td bgcolor="<?php echo $color;?>" class="precionormal2"><div align="center"><span class="<?php echo $estilo;?>">
	   
      <span class="style12"><span class="style7">
      <?php 

	if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='A'){
	print '-';
	}else{
	print $myrow81['naturaleza'];
	}
	
		?>
    </span></span> </span></div></td>
	</tr>
 
	
	<?php if($myrow81['statusDescuento']=='si'){ $statusD='disabled';}?>
    <?php }//cierra while
	
	?>
	
	
	
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" alt="bo1" width="723" height="24" />


  
  
  
  
  
  
  
  
  
  
  
  <table width="723" border="0" align="center">

    <tr>
      <td width="83" class="style12">&nbsp;</td>
      <td width="83" class="style12">&nbsp;</td>
      <td width="83" class="style12">&nbsp;</td>
      <td width="83" class="style12">&nbsp;</td>
      <td width="179" class="style12">&nbsp;</td>
      <td width="60" class="style12">&nbsp;</td>
      <td width="43" class="style12">&nbsp;</td>
      <td width="57" class="style12">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <?php	 
$mostrarCuadroGP=new cuadritoAcumuladoGPO();
echo $mostrarCuadroGP->mostrarCuadrito($_POST['fecha'],$_POST['fecha2'],'precionormal1',$entidad,$myrow3['folioVenta'],$basedatos);
    ?>
  
  
  
<?php $iva=new acumulados();
$ivaD=new acumulados();
$iva=$iva->ivaAcumulado($basedatos,$usuario,$nT)-$ivaD->ivaAcumuladoD($basedatos,$usuario,$nT);		
?>
  <div align="center">
    <table width="396" border="1" align="center" class="style12">
      <tr>
        <td height="23" colspan="3" class="style12"><div align="center" class="style25">Cargos Globales </div></td>
      </tr>
      <tr>
        <td width="119" class="style12"><span class="style7">Total Cargos </span>
        <?php 
			
		$coaseguroN=new acumulados();
		$coa=$coaseguroN->cargosCoaseguroN($basedatos,$usuario,$nT);	
		$totalAcumulado=new acumulados();
		$totalDevoluciones=new acumulados();
		$cargos=(($totalAcumulado->totalAcumulado($basedatos,$usuario,$nT)-$totalDevoluciones->dev($basedatos,$usuario,$myrow3['folioVenta']))+$iva)+$coa;
		

		

		echo "$".number_format($cargos,2);?>
        
        </td>
        <td width="111" height="23" class="style12"><span class="style7">Total Abonos     
           <?php 		 
		$abonos=new acumulados();
		$abonoS=$abonos->abonos($basedatos,$usuario,$myrow3['folioVenta']); 
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$myrow3['folioVenta']),2); ?>
        </span></td>
        <td width="152" class="style12"><div align="right">
        Saldo Actual 
          <?php
			  if($abonoS<0){
		$STotal=$cargos+$abonoS;
		}else{
		$STotal=$cargos-$abonoS;
		}
		echo "$".number_format($STotal,2);
		?>
		
        </div></td>
      </tr>
    </table>


  </div>
  <p align="center" class="style7">
  
<?php 

 $sSQL811= "
SELECT statusCargo

FROM
cargosCuentaPaciente 
 WHERE 
 keyClientesInternos='".$_GET['nT']."'
and
statusCargo='standby'

 
 
";

$result811=mysql_db_query($basedatos,$sSQL811);
$myrow811 = mysql_fetch_array($result811);




if($myrow811['statusCargo']){ ?>
 <input name="nuevo" type="button" class="style7" id="nuevo" value="Falta Surtir Articulos" disabled=""/>

<?php } else { ?>
    <input name="nuevo" type="button" class="style7" id="nuevo" value="Cargar Deducible/Coaseguro"
	  onclick="ventanaSecundaria10('aplicarDeducibleVentana.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&almacen=<?php echo $_GET['almacen']; ?>&almacenFuente=<?php echo $_GET['almacen']; ?>&nT=<?php echo $_GET['nT'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&cantidadTotal=<?php echo $STotal;?>')" />
	
	     
	  <?php } ?>
  </p>
</form>

<p align="center">&nbsp;</p>

</body>
</html>
<?php 
}

}
?>

