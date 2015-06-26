<?php
Session_Start();
include_once "check.php";
require_once "class.entity.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$obj=new  CFEntity(); 

	$title=$_POST["submit_title"];


	$result=$obj->getRes("SELECT id FROM  `course` WHERE title='".$title."' limit 0,1");
	if(mysql_fetch_array($result)){
		echo "此文章已经存在，请不要重复提交";

	}else{
		$sql="insert into  `course` (title,teacherIds, userId,createdTime) values ('".$title."','|1|',1,'".time()."')";
		echo $sql;
		$obj->getRes($sql);
		$courseid=mysql_insert_id();

		$j=count($_POST["submit_section"]);

		
		

		for($i=0;$i<$j;$i++){
			$title=$_POST["submit_section"][$i];
		    $content=$_POST["submit_content"][$i];;
			$sql="insert into `course_lesson` (courseId,number,seq,free,title, content,createdTime) values (".$courseid.",".($i+1).",".($i+1).",1,'".$title."','".$content."','".time()."' )";
			$obj->getRes($sql);
			echo $sql;

		}






		
	}

}

?>
