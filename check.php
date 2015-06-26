<?php
Session_Start();
if(!isset($_SESSION["zhuaqu_content"])){
	header('Location: index.php');
}

if( !isset($_SESSION["zhuaqu_access"])  ||  $_SESSION["zhuaqu_access"]!="ok"){
	header('Location: index.php');
}
?>
