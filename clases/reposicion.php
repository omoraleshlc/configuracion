<form id="form1" name="form1" method="post" action="#">
  <table width="100" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="../imagenes/bordestablas/borde1.png" width="100" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="10" class="negromid">#</td>

      <td width="20" class="negromid">Usuario</td>

    </tr>
<?php 
if(!$ALMACEN){echo '<script>window.alert("Favor de Revisar, no tiene almacen definido en modulos primarios...");</script>';}
$sSQL= "
SELECT *
FROM
articulosSolicitudes
where

entidad='".$entidad."'
and
usuario='".$usuario."'
    and
    status='venta'
group by usuario

";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;

$fV[0]=$myrow['folioVenta'];
$sSQL8aa= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and

 almacen='".$myrow['almacenDestino']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
?>

	  <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $a;?></td>
      <td class="normalmid"><span class="normal">
 <a href="#"  onclick="javascript:ventanaSecundaria('../cargos/solicitaReposicion.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>');">
        <?php

		echo $myrow['usuario'];
		?>
      </a> </span></td>



      

    </tr>
    <?php  }?>
    <tr>
      <td colspan="6"><img src="../imagenes/bordestablas/borde2.png" width="100" height="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center"><span class="style7">

  </span></p>
</form>