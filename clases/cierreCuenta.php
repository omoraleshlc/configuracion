<?php class close{ 
public function closing($keyClientesInternos,$basedatos){?>
<table width="86%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="15%" scope="col">
		
		
		
		<table width="94" border="0" align="left">
          <tr bgcolor="#660066">
            <th class="blanco" scope="col">
			
			<span class="blanco">Particular<a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>')"> </a></span></th>
          </tr>
          <tr>
            <th width="98" bgcolor="#660066" class="blanco" scope="col"><span class="blanco"> <span class="blanco">Total a pagar </span> </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal"> <span class="normal">
                <?php  //echo "$".number_format($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta),2);

			
		
		$ttP=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
		// $T=round($T,$ase);
		if($ttP){ 
		
		if($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos'])<0){
				$dev='si';
		$cantidadDevolucion=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
		}else{
		$dev='';
		}
		
		?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?almacenFuente=<?php echo $bali; ?>&numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoTransaccion=particular&random=<?php echo rand(90000,900000000);?>&devolucion=<?php print $dev;?>&cantidadDevolucion=<?php echo $cantidadDevolucion;?>')">
                <?php 	
        
		echo "$".number_format($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']),2);
		?>
                </a>
                <?php 
		} else {
	
	    echo "$".number_format($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']),2);
		}
		?>
            </span></span></div></td>
          </tr>
        </table>
		
		
		
		</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="15%" scope="col"><table width="94" border="0" align="center">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">Otros Clientes </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066" scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
                <?php //*******************OTROS**********************
		$otros=new acumulados();
		$ttO=$otros->otros($basedatos,$usuario,$numeroE,$nCuenta);
		if($ttO){    ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'otros';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoTransaccion=otros&random=<?php echo rand(90000,900000000);?>')">
                <?php 
		echo "$".number_format($otros->otros($basedatos,$usuario,$numeroE,$nCuenta),2);?>
                </a>
                <?php } else {
		
		echo "$".number_format($otros->otros($basedatos,$usuario,$numeroE,$nCuenta),2);
		}
		?>
            </span></div></td>
          </tr>
        </table></th>
            
        
        
        
        
        <th width="31%" scope="col">&nbsp;</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="5%" scope="col">&nbsp;</th>
        <th width="16%" scope="col"><table width="94" border="0">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">D.Coaseguro </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066"  scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
                <?php 
		$coaseguro=new acumulados();
		$ttCO=$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']);
		if($ttCO){    ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'coaseguro';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoTransaccion=coaseguro&random=<?php echo rand(90000,900000000);?>')">
                <?php 
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']),2);?>
                </a>
                <?php } else {
		
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']),2);
		}
		?>
            </span></div></td>
          </tr>
        </table></th>
        <th width="14%" scope="col"><table width="94" border="0" align="right">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco"> Compa&ntilde;&iacute;a
                  <?php //echo "$".number_format($Tcargos,2);?>
                  <?php //echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
                  <?php //echo "$".number_format($deposito[0],2);
	  //echo "Pago por Otros";
	  $t2=$Tabonos;?>
            </span></th>
          </tr>
          <tr>
            <th width="172" bgcolor="#660066" class="blanco" scope="col">Saldo Cia. </th>
          </tr>
          <tr>
            <td><span class="normal">
            

              <?php 
			  $ttCA=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT'] );
		if($ttCA && !$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT'])){ ?>
              <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
		&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'aseguradora';?>&tipoVenta=<?php echo 'interno';?>&tipoTransaccion=aseguradora&random=<?php echo rand(90000,900000000);?>')">
              <?php 
			echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT']),2);?>
              </a>
              <?php } else {
		
		echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT']),2);
		}		
		?>
        
    
        
        
            </span> </td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php
	}
	}
	
	?>