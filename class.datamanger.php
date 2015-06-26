<?php
class DataManager{
	public static function _getConnection(){
		static $hDB;
		
		if(isset($hDB)){
			return $hDB;
		}
		
		
		$hDB=mysql_connect("localhost","root","111111") or die("Failure connecting to the database!");
		mysql_query("set names utf8");
		mysql_select_db("mytable", $hDB);
		return $hDB;
			
	}
	
	
	
	
}
?>
