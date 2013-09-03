<?php class resuelveIP{
public function ip(){
#
# http://www.lawebdelprogramador.com
#
# codigo que intenta mostrar la IP local, IP pública, la IP del proxy y el hostname de la IP pública
#

if($_SERVER["HTTP_X_FORWARDED_FOR"])
{
	if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," "))
	{
		 "IP local: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." - IP Pública: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
		$hostlocal=substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
	}else{
		"IP Pública: ".$_SERVER["HTTP_X_FORWARDED_FOR"];
		$hostlocal=$_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	if($_SERVER["REMOTE_ADDR"])
		 " - Proxy: ".$_SERVER["REMOTE_ADDR"];
}else{
	"IP  ".$_SERVER["REMOTE_ADDR"];
	$hostlocal=$_SERVER["REMOTE_ADDR"];
	if($hostlocal!=$_SERVER["REMOTE_ADDR"])
		 " - Hostname: ".$hostlocal;
}
$hostname=gethostbyaddr($hostlocal);
if($hostlocal!=$hostname)
return	$hostname;
}
}
?>