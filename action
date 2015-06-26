<?php
Session_Start();
require_once "simple_html_dom.php";
require_once "config.php";
$pwd=$_POST["pwd"];

if($pwd!=PASSWORD){
	$_SESSION["zhuaqu_access"]="no";
	die("密码错误！");

}else{
	$_SESSION["zhuaqu_access"]="ok";
	$url= $_POST["url"];
	$src=$_POST["src"];
	$_SESSION["zhuaqu_url"]=$url;
	$_SESSION["zhuaqu_node"]=$link[$src];
	$contentnode=$link[$src][5];


	parse($url,$contentnode);
	header('Location: parse.php');

}

function parse($url,$node){
	  $html = new simple_html_dom();
      $html->load_file($url);
	  $content = $html->find($node, 0)->innertext;   
	  $_SESSION["zhuaqu_content"]=$content;
	}
      


?>
