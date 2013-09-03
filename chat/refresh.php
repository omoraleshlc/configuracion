<?php
//session_start();
require_once("/configuracion/chat/chat.php");
$refresh = new chat();
require_once("/configuracion/chat/chat.php");
echo $query="select * from chat";
$a=$refresh->connect_easy($query);
$refresh->show($a);
?>
