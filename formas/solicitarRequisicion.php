<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=900,height=800,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=300,scrollbars=YES") 
   
} 
</script>
<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=600,height=600,scrollbars=YES") 
} 
</script>
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style8 { background-color:#990033;font-size: 9px; color:#FFFFFF; border-bottom-color:#0000FF; display:block}
-->
</style>
<div align="center">

  <p>
  <?php //echo $ALMACEN;?>
  &nbsp;</p>
  <p><img src="/sima/imagenes/imagenesModulos/<?php echo $imagen;?>" width="655" height="309"></p>
  <p>
  
  <p>  
  <table width="37%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="middle">
      <td width="34%"><div align="center">
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aquí para generar una Orden de Compras..';?></div>')" onMouseOut="UnTip()" name="nuevo" 
		type="image"   id="nuevo" value="....." src="/sima/imagenes/btns/genorden.png"
	  onclick="ventanaSecundaria1('<?php echo $ventana1;?>?cargos=cargos&almacen=<?php echo $ALMACEN;?>')" />
      </div></td>
      <td width="36%"><div align="center"></div></td>
      <td width="30%"><div align="center">
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aquí para ver la Listas Generadas';?></div>')" onMouseOut="UnTip()" name="nuevo22" type="image" src="/sima/imagenes/btns/lisorden.png" id="nuevo22" value="List&acirc;o de Ordem"
	  onclick="ventanaSecundaria11('<?php echo $ventana11;?>?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" />
      </div></td>
    </tr>
  </table>
  <p> 
</div>
