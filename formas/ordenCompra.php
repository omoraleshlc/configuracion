<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
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
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aqui para generar una Orden de Compra';?></div>')" onMouseOut="UnTip()" name="nuevo" 
		type="image"   id="nuevo" value="....." src="/sima/imagenes/btns/genorden.png"
	  onclick="nueva('<?php echo $ventana1;?>?cargos=cargos&almacen=<?php echo $ALMACEN;?>','ventana7','800','500','yes')" />
      </div></td>
      <td width="36%"><div align="center"></div></td>
      <td width="30%"><div align="center">
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aqu� para ver la Listas Generadas';?></div>')" onMouseOut="UnTip()" name="nuevo22" type="image" src="/sima/imagenes/btns/lisorden.png" id="nuevo22" value="List&acirc;o de Ordem"
	  onclick="nueva('<?php echo $ventana11;?>?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" />
      </div></td>
    </tr>
  </table>
  <p> 
</div>
