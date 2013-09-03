<?PHP include("/configuracion/ventanasEmergentes.php"); ?>


<script language=javascript> 


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

        if( vacio(F.precio.value) == false ) {   
                alert("Escoje el nuevo precio del articulo!")   
                return false   
        } else if( vacio(F.existencia.value) == false ) {   
                alert("Te falta asignar la existencia  a este articulo!")   
                return false   
        }   else if( vacio(F.cantidades.value) == false ) {   
                alert("Escoje tu transacción, si es entrada o salida!")   
                return false   
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

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=390,height=420,scrollbars=NO") 
} 
</script> 

<?php
$codigo=$_GET['codigo'];
$id_requisicion=$_GET['id_requisicion'];



if($_POST['id_proveedor'] and $_POST['agregarProveedor'] and $_POST['cantidad']){
if($_POST['id_proveedor']=='sin'){
$_POST['id_proveedor']="";
}

$sSQL17= "Select * From requisiciones WHERE codigo = '".$codigo."' and statusCompras='comprar'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$codec=$myrow17['codigo'];
if($codec){
$q = "UPDATE requisiciones set 
id_proveedor='".$_POST['id_proveedor']."',
usuarioCompras='".$usuario."',
fechaCompras='".$fecha1."',
horaCompras='".$hora1."'
WHERE 
statusCompras='comprar' and codigo='".$codigo."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL PROVEEDOR!!"
</script>';
} else {
$agregaSaldo = "INSERT INTO requisiciones ( codigo,id_proveedor,cantidadComprar,usuarioCompras,fecha,hora
) values ('".$codigo."','".$_POST['id_proveedor']."','".$_POST['cantidad']."','".$usuario."','".$fecha1."',
'".$hora1."'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL PROVEEDOR!!"
</script>';
}
}





?>

<?php 
$sSQL1= "SELECT 
* 
FROM `articulos`
WHERE
codigo='".$codigo."'

";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style13 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>

<h1 align="center">Agregar Proveedor </h1>
<p align="center" class="style13"><?php echo $codigo=$myrow1['codigo']; ?></p>
<p align="center" class="style13"><?php echo $descripcion=$myrow1['descripcion']; ?></p>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <table width="463" border="1" align="center">
    <tr>
      <th width="165" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="282" bgcolor="#660066" scope="col"><span class="style11">Operaciones</span></th>
    </tr>
    <tr>
	

      <td bgcolor="<?php echo $color?>" class="Estilo24">Proveedor:</td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><label>
        <?php $aCombo= "Select * From proveedores where status='A' order by id_proveedor ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="id_proveedor" class="Estilo24" id="id_proveedor" />
<?php if($_POST['id_proveedor']){ ?>
<option value="<?php echo $_POST['id_proveedor'];?>"><?php echo $_POST['id_proveedor'];?></option>
<?php } ?>
        <option value="sin">Quitar Proveedor</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option value="<?php echo $resCombo['id_proveedor']; ?>"><?php echo $resCombo['razonSocial']; ?></option>
        <?php } ?>
        </select>
      <?php 
	  if($myrow18['cantidad']){
	  echo "Este almacén está solicitando ".$myrow18['cantidad']." artículos";
	  }
	  ?>
	  </label></td>
    </tr>
	     
	
	
            <tr>
		
              <td bgcolor="<?php echo $color?>" class="Estilo24">Cantidad:</td>
              <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
                <input name="cantidad" type="text" class="style7" id="cantidad" value="<?php echo $myrow17['precio']; ?>"  size="9" maxlength="9" />
              </span></td>
            </tr>
    <tr>
      <td bgcolor="<?php echo $color?>" class="Estilo24">Hora:</td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><?php echo $hora1;?>&nbsp;
      <input name="codigo" type="hidden" id="codigo"  value="<?php echo $codigo;?>"/>
      <input name="descripcion" type="hidden" id="descripcion"  value="<?php echo $descripcion;?>"/></td>
    </tr>
    <tr>
      <td bgcolor="<?php echo $color?>" class="Estilo24">Fecha:</td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><?php echo $fecha1;?>&nbsp;
      <input name="banderaLoca" type="hidden" id="banderaLoca" value="<?php echo $banderaLoca;?>" /></td>
    </tr>
    <?php   //cierra while ?>
  </table>
  <p align="center"><label></label>
    <label>
    <input name="agregarProveedor" type="submit" class="style7" id="agregarProveedor" value="Agregar Proveedor" />
    </label>
  </p>
</form>

</body>
</html>