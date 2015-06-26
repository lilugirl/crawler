<?php
Session_Start();
session_unset();
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>
    	</title>
	</head>
	<body>
		数据抓取
		<form action="action.php" method="post">
			<input name="url" placeholder="请输入网址"><br/>
			<select name="src">
              <option value="jianshu">简书</option>
              <option value="cnblogs">博客园</option>
			</select>
			<input name="pwd" type="password" placeholder="请输入操作密码"><br/>
			<input type="submit" value="提交" />
		</form>
	</doby>
</html>
