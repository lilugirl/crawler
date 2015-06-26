<?php
Session_Start();
require_once "simple_html_dom.php";
include_once "check.php";

$node=$_SESSION["zhuaqu_node"];


$html = new simple_html_dom();
$html->load_file($_SESSION["zhuaqu_url"]);
$title = $html->find($node[5], 0)->find($node[2],0)->plaintext;  
$sections = $html->find($node[5], 0)->find($node[3]);
$breif=$html->find($node[5], 0)->find($node[3],0)->prev_sibling()->innertext; ;
$count=count($sections);

foreach($sections as $section){
	$article["content"]=$section->next_sibling()->innertext;
	$article["title"]=$section->plaintext;
	$articles[]=$article;

	
}

?>
<!DOCTYPE html>
<html>
<head>
	<script src="jquery.min.js"></script>
	<style>
	 .clear{
	 	clear:both;
	 }
	  #localfile,.submit_content2{
	  	width:45%;
	  	height:300px;
	  	overflow:scroll;
	  	border:1px solid #f00;
	  	float:left;
	  }
	   #localfile_html,.submit_content{
	  	width:45%;
	  	height:300px;
	  	overflow:scroll;
	  	border:1px solid #f00;
	  	float:left;
	  	margin-left:5%;

	  }
	  input:focus,textarea:focus{
	  	border:1px solid #f00;
	  	background:#fcc;
	  }
	  #submit_title,.submit_section{
	  	width:800px;
	  }

	  
	</style>
	<script>



	
	   $(function(){

	   	
	   	  $('.btn1').bind("click",function(event){
	   	  	event.preventDefault();
	   	  	var titleselector=" #localfile " + $("#title").val();
	   	  	var sectionselector=" #localfile " + $("#section").val();
	   	  	
	   	  
	   	  	var i;
	   	  	var j=<?php echo $count; ?>;
	   	  	var contenthtml=["subtitle","subcontent"];
	   	    contenthtml["subtitle"]=new Array();
	   	    contenthtml["subcontent"]=new Array();


	   	    

	   	  
	   	  	
	   	  	for(i=0; i<j;i++){

	   	  		var thisselector= sectionselector + ":eq(" + i + ")";	   	  		   	  		
	   	  		var thispselector= "#"+$(thisselector).attr("id") + "+ p";
	 
	   	  		contenthtml["subtitle"][i]=$(thisselector).text();
	   	  		contenthtml["subcontent"][i]=$(thispselector).html();



		

	   	  	}

	   	  
	   	  	var htmltitle="<input name='submit_title' id='submit_title' value='<?php echo $title; ?>' /><br/><br/>";
	   	  	$("#adjust").append(htmltitle);



	   	  	$("<iframe id='brifb' class='submit_content' frameBorder=0></iframe>").appendTo('#adjust');  
            $("<textarea id='brif2b' name='brif' class='submit_content2' name='submit_content[]'></textarea><br/><br/>").appendTo('#adjust');

            var iframe=$("#brifb")[0];
            var text=$("#brif2b");
               
                var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                iframeDocument.designMode = "on";
                iframeDocument.open();
                iframeDocument.write('<html><head><style type="text/css">body{ font-family:arial; font-size:13px;background:#DDF3FF }</style></head></html>');
                iframeDocument.close();



                $(text).val("<?php echo $breif; ?>");
                $(iframe).contents().find("body").html("<?php echo $breif; ?>");



                 $($("iframe")[0].contentWindow).blur(function(){
            
                     $("#brif2b").val($("#brifb").contents().find("body").html());
                 });


                  $("#brif2b").blur(function(){
            
                  $("#brifb").contents().find("body").html($("#brif2b").val());
                  });



	   	   

               




	   	  	


	   	  	for (i=0;i<j;i++){
	   	  
	   	  		var htmlsection="<input name='submit_section[]' class='submit_section' value='" + contenthtml["subtitle"][i] + "' /><br/>";
	   	  		
	   	  		$("#adjust").append(htmlsection);
	   	  	

	   	  		$("<iframe id='Frame"+i+"' class='submit_content' frameBorder=0></iframe>").appendTo('#adjust');  
                $("<textarea id='Text"+i+"' class='submit_content2' name='submit_content[]'></textarea><br/><br/>").appendTo('#adjust');

                var iframe=$("#Frame"+i)[0];
                var text=$("#Text"+i)[0];
               
                var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                iframeDocument.designMode = "on";
                iframeDocument.open();
                iframeDocument.write('<html><head><style type="text/css">body{ font-family:arial; font-size:13px;background:#DDF3FF }</style></head></html>');
                iframeDocument.close();



                $(text).val(contenthtml["subcontent"][i]);
                $(iframe).contents().find("body").html(contenthtml["subcontent"][i]);


               
                binding(i);
	   	  	}


	   	  
	   	  	
	   	  	
	   	  });

          


        

           

          function binding(i){
                var frameselector="#Frame"+i;
                var textselector="#Text"+i;

                 $($("iframe")[i+1].contentWindow).blur(function(){
            
                     $(textselector).val($(frameselector).contents().find("body").html());
                 });


                  $(textselector).blur(function(){
            
                  $(frameselector).contents().find("body").html($(textselector).val());
                  });


              }



         


           $('.btn2').bind("click",function(event){
           	    var $this = $(this);
          		
          });





	   });
	</script>

</head>
<body>

	<h2>抓取原文</h2> 
	<div>
	<a href="<?php echo $_SESSION["zhuaqu_url"];  ?>" target="_blank"><?php echo $_SESSION["zhuaqu_url"];  ?></a>
    </div><br/>
	<div id="localfile">

		<?php echo $_SESSION["zhuaqu_content"];?>
	</div>

	<div id="localfile_html">
		<pre>
		<?php echo htmlspecialchars($_SESSION["zhuaqu_content"]);?>
	</pre>
	</div>

	<div class="clear"></div>

	<div id="parse">
		<h2>解析区域</h2>
		<form action="">
			<label>title 选择器</lable>
			<input name="title" id="title"  placeholder="title 选择器" value="<?php echo $node[2]; ?>" />
			

			<label>section 选择器</lable>
			<input name="section" id="section"  placeholder="section 选择器" value="<?php echo $node[3]; ?>" />
			<button class="btn1">提交</button>
		</form>
	</div>

	<div id="adjustarea">
		<h2>提交区域</h2>
		<form id="adjust" method="post" action="submit.php">
			
			

<input type="submit" value="提交表单" />
			
		</form>
	</div>
</body>
</html>
