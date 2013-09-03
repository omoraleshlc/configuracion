<?php class desbloquea{

public function unblock($fecha1,$hora1,$usuario,$basedatos){
$q = "UPDATE usuarios set
fechaIngreso='".$fecha1."',
horaIngreso='".$hora1."',
llave='',
status='inactivo'
WHERE

usuario='".$usuario."' 
";
mysql_db_query($basedatos,$q);
echo mysql_error(); ?>

<?php 
}
}
?>