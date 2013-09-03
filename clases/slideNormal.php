<table width="612" border="1" align="center" class="normal">
    <tr>
      <td width="93" height="25" bgcolor="#FFFF00">Particular</td>
      <td width="103" bgcolor="#FFFF00">Aseguradora</td>
      <td width="97" bgcolor="#FFFF00">Coaseguro1</td>
      <td width="97" bgcolor="#FFFF00">Coaseguro2</td>
      <td width="90" bgcolor="#FFFF00">Deducible1</td>
      <td width="92" bgcolor="#FFFF00">Deducible2</td>
    </tr>
    <tr>
      <td><?php if(round($totalParticular,2)>0){ ?>
  <?php echo '$'.number_format($totalParticular,2);?>  
      <?php } else{
echo 'Ok';
} ?></td>
      <td>
	        <?php if($totalAseguradora>0){ ?>
           <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	        <?php if($totalCoaseguro1>0){ ?>
            <?php echo '$'.number_format($totalCoaseguro1,2);?>
      <?php } else{
echo 'Ok';

} ?>	  </td>
      <td>
	  	  	        <?php if($totalCoaseguro2>0){ ?>
 <?php echo '$'.number_format($totalCoaseguro2,2);?>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	  	  	        <?php if($totalDeducible1>0){ ?>
          <?php echo '$'.number_format($totalDeducible1,2);?>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	  	  	  	        <?php if($totalDeducible2>0){ ?>
              <?php echo '$'.number_format($totalDeducible2,2);?>
      <?php } else{
echo 'Ok';
} ?>	  </td>
    </tr>
  </table>