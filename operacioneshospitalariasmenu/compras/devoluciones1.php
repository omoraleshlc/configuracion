<?php include("/configuracion/operacioneshospitalariasmenu/compras/menucompras.php"); ?>
<?PHP include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=300,scrollbars=YES") 
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

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<?php

$ali=$ALMACEN;
$sSQL6= "Select * From listaOC WHERE entidad='".$entidad."' AND nRequisicion='".$_POST['ordenesActivas']."' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
if($myrow6['id_proveedor']){
$_POST['id_proveedor']=$myrow6['id_proveedor'];
}














if($_POST['devolver']  and $_POST['id_proveedor'] and $_POST['tipoTransaccion'] ){


$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];
$oc=$_POST['oc'];







for($i=0;$i<$_POST['pasoBandera'];$i++){


$sSQL3= "Select * From existencias WHERE entidad='".$entidad."' AND codigo= '".$code1[$i]."' and almacen='".$ali."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($cantidad[$i]<$myrow3['existencia'] and $cantidad[$i]>0){
$leyenda= "SE AJUSTARON LAS EXISTENCIAS!!";

if($code1[$i]){//validacion de cantidad
$agregaSaldo = "INSERT INTO devoluciones ( codigo,cantidad,id_proveedor,usuario,fecha,hora,tipoTransaccion,observaciones,
id_almacen,entidad
) values ('".$code1[$i]."','".$cantidad[$i]."','".$_POST['id_proveedor']."',
'".$usuario."','".$fecha1."','".$hora1."','".$_POST['tipoTransaccion']."','".$_POST['observaciones']."','".$ali."','".$entidad."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
$q4 = "UPDATE existencias set 
existencia=existencia-'".$cantidad[$i]."',
usuario='".$usuario."',
fechaA='".$fecha1."',
hora='".$hora1."',
ID_EJERCICIO='".$ID_EJERCICIOM."'
WHERE 
entidad='".$entidad."' AND
codigo = '".$code1[$i]."'

and
almacen='".$ali."'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

//$leyenda= "SE AJUSTARON LAS EXISTENCIAS!!";
}//if
}else{
//pasa limite


//$leyenda= "LA CANTIDAD QUE ESTAS SOLICITANDO EXCEDE EL MAXIMO PERMITIDO DE EXISTENCIAS DEL ALMACEN!!";

}
} //cierra for

}








?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 14px}
.style11 {color: #000; font-size: 14px; font-weight: normal; }
.style12 {font-size: 14px}
.Estilo3 {font-size: 14px; font-family: "Times New Roman", Times, serif; color: #000; font-weight: normal; }
.Estilo24 {font-size: 14px}
.style18 {font-size: 14px; font-style: normal; }
.style19 {
	color: #FF0000;
	font-weight: normal;
}
-->
</style>
</head>

<h1 align="center">Hacer una Devoluci&oacute;n </h1>
<form id="form2" name="form2" method="post" action="">
  <img src="../../imagenes/bordestablas/borde1.png" width="660" height="24" />
  <table width="659" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="22" bgcolor="#CCCCCC" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="89" bgcolor="#CCCCCC" class="style7" scope="col"><div align="left"><span class="Estilo24">Art&iacute;culo </span></div></th>
      <th width="524" bgcolor="#CCCCCC" class="style7" scope="col"><div align="left"><span class="Estilo24">
        <input name="nomArticulo" type="text" class="Estilo24" id="nomArticulo" size="60" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
        </span><span class="Estilo24">
          </select>
      </span></div></th>
    </tr>
    <tr>
      <th bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" class="style7" scope="col"><div align="left">Proveedor:</div></th>
      <th bgcolor="#CCCCCC" class="style7" scope="col"><div align="left">
        <p>
          <input name="id_proveedor" type="text" class="Estilo24" id="id_proveedor"   readonly=""
		value="<?php if($_POST['id_proveedor']){ echo $_POST['id_proveedor'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
          <span class="Estilo24">
            <input name="agregarCargos3" type="submit" class="Estilo24" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarProveedores.php?campoDespliega=<?php echo "nombreProveedor"; ?>&amp;forma=<?php echo "form2"; ?>&amp;campoProveedor=<?php echo "id_proveedor"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="P">
            </span></p>
        <p><span class="Estilo24">
          
          <input name="nombreProveedor" type="text" class="Estilo24" id="nombreProveedor" size="60" 
		  
		  value="<?php  echo $_POST['nombreProveedor']; ?>"  readonly=""/>
          
          
          </span><span class="Estilo24">
            
            </span><span class="Estilo24">
              
            </span></p>
      </div></th>
    </tr>
    <tr>
      <th height="24" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col"><div align="left" class="style7">Tipo de Dev. </div></th>
      <th bgcolor="#CCCCCC" scope="col"><div align="left"><span class="Estilo24">
        <select name="tipoTransaccion" class="Estilo24" id="tipoTransaccion" onChange="javascript:this.form.submit();">
          <?php 
		 if($_POST['tipoTransaccion']){ ?>
          <option value="<?php echo $_POST['tipoTransaccion'];?>"><?php echo $_POST['tipoTransaccion'];?></option>
          
          <?php }
		 ?><option value="">----</option>
          <option value="caducidad">caducidad</option>
          <option value="mercancia danada">mercancia danada</option>
        </select>
      </span></div></th>
    </tr>
    <tr>
      <th height="24" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" class="style7" scope="col">Observaciones</th>
      <th bgcolor="#CCCCCC" scope="col"><div align="left"><span class="Estilo24">
<textarea name="observaciones" cols="57" class="Estilo24" id="observaciones"><?php if($_POST['observaciones']){ echo $_POST['observaciones']; }?>
        </textarea>
      </span></div></th>
    </tr>
    <tr>
      <th height="24" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col"><div align="left">
	  <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" 
	  <?php if(!$_POST['id_proveedor']){
	  //echo 'disabled="disabled"';
	  }?>
	  />
          <?php if($_POST['nomArticulo']==='*'){ ?>
          <span class="style18">Este proceso puede demorar varios minutos...</span>
          <?php } ?>
          <input name="nomPoveedor" type="hidden" id="nomPoveedor" value="<?php echo $_POST['nomProveedor']; ?>" />
      </div>
      </label></th>
    </tr>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="660" height="24" />
<p align="center">&nbsp;</p>
</form>
<p align="center" class="style19"><?php echo $leyenda;?>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <div align="center"></div>
  <img src="../../imagenes/bordestablas/borde1.png" width="579" height="24" />
  <table width="579" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="59" bgcolor="#FFFF00" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="281" bgcolor="#FFFF00" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="34" bgcolor="#FFFF00" scope="col"><span class="style11">UM</span></th>
      <th width="52" bgcolor="#FFFF00" scope="col"><span class="style11">Existe</span></th>
      <th width="59" bgcolor="#FFFF00" scope="col"><span class="style11">Cantidad</span></th>
      <th width="68" bgcolor="#FFFF00" scope="col"><span class="style11">Devolver</span></th>
    </tr>
    <tr>
<?php	

if(!$requisicion){
$requisicion=$_POST['ordenesActivas'];
}

if($_POST['nomArticulo']){
$articulo=$_POST['nomArticulo'];
$sSQL18= "
SELECT 
*
FROM
articulos,existencias
WHERE 
articulos.entidad='".$entidad."' AND
existencias.almacen='".$ali."' 
and
existencias.codigo=articulos.codigo 
and
(articulos.descripcion LIKE '%$articulo%' or articulos.descripcion1 LIKE '%$articulo%' )
order by existencias.codigo 
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$disponible=$myrow18['existencia']-$myrow18['reorden'];
$b+='1';
$a+='1';

$code1=$myrow18['codigo'];


if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From OC WHERE entidad='".$entidad."' AND codigo= '".$code1."' 
and status='solicita' order by keyR DESC
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


$sSQL7= "Select * From articulos WHERE entidad='".$entidad."' AND codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


//*********************************************************************************************************
$sSQL8= "
SELECT 
*
FROM
existencias
WHERE 
entidad='".$entidad."' AND 
existencias.almacen='".$ali."' 
and

existencias.existencia >=existencias.reorden
and 
existencias.reorden is not null 
and 
existencias.reorden <>'0'
and 
existencias.codigo='".$code1."'

order by existencias.codigo ASC
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if($col){
$color = '#FFFF99';
$col = "";

} else {
$color = '#FFFFFF';
$col = 1;
}

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7"><?php echo $code1?></span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$code1,$basedatos);
		
		?>
        <span class="Estilo24">
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['existencia']>0){
	  echo $myrow18['existencia'];
	  } else {
	  echo "Sin Existencia";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <span class="Estilo24">
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="0" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <input name="request[]" type="checkbox" id="request[]" value="<?php echo $code1?>"
	 />
      </span></span></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="579" height="24" />
<div align="center"><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    <input name="devolver" type="submit" class="style12" id="devolver" value="Aplicar Cambios"    <?php if(!$_POST['id_proveedor']){
	  echo 'disabled="disabled"';
	  }?>/>
    </label>
    <label></label>
    <input name="nomArticulo" type="hidden" id="nomArticulo" value="<?php echo $_POST['nomArticulo']; ?>" />
    <input name="nombreProveedor" type="hidden" id="nombreProveedor" value="<?php echo $_POST['nombreProveedor']; ?>" />
    <input name="observaciones" type="hidden" id="observaciones" value="<?php echo $_POST['observaciones']; ?>" />
  </p>
  <p align="center">
    <input name="id_proveedor" type="hidden" id="id_proveedor" value="<?php echo $_POST['id_proveedor']; ?>" />
    <input name="ordenesActivas" type="hidden" id="ordenesActivas" value="<?php echo $_POST['ordenesActivas']; ?>" />
    <input name="nomPoveedor" type="hidden" id="nomPoveedor" value="<?php echo $_POST['nomProveedor']; ?>" />
    <input name="tipoTransaccion" type="hidden" id="tipoTransaccion" value="<?php echo $_POST['tipoTransaccion']; ?>" />
  </p>
</form>
</body>
</html>