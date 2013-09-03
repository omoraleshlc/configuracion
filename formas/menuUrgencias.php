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

<div align="center">

  <p>
  <?php //echo $ALMACEN;?>
  &nbsp;</p>
  
  <p>
<table width="37%" class="table-forma">
    <tr valign="middle">
      <td width="34%"><div align="center">
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aquí para hacer notas de cargo..';?></div>')" onMouseOut="UnTip()" name="nuevo" type="submit"  id="nuevo" value="Internar paciente" 
	  onclick="ventanaSecundaria1('<?php echo $ventana1;?>?cargos=cargos&almacen=<?php echo $_GET['datawarehouse'];?>')" />
      </div></td>
    </tr>
  </table>
  <p> 
</div>
