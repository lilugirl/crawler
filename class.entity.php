  <?php
/*
*  实体类
*    
*
*
*/
require_once "class.datamanger.php";
Class CFEntity
{
	public function getRes($sql)
	{
		if( !($this->checkStr("delete",$sql)) )   //保护输入的内容 不允许删除操作
		{
			$res=mysql_query($sql,DataManager::_getConnection());
			if($res)
			{
		      return $res;
			}
			else
			{
			  echo mysql_error();
			  echo "<br/>";
			  echo $sql;
			  echo "<br/>";
			}
		 
		  
		}
		else
		{
			return false;
		}
		
		
	
	}
	
	public  function checkStr($str,$target)
      {
           $tmpArr = explode($str,$target);
           if(count($tmpArr)>1)return true;
           else return false;
      }
     
	
}

?>
