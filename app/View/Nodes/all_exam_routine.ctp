<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>All Notice</title>
	 <style>
		#link{color:blue;}
	 </style>
</head>
<body>
    <div id="page-wrap">
    <?php 
		$notices = $this->requestAction('nodes/all_exam_routine'); 
		foreach($notices as $notice):		
	?>       
            <h1 style="font-size:17px;"><?php echo $notice['Node']['title']; ?></h1>       
            <p>
                <?php 					
					$position=200; 
					$message=$notice['Node']['body'];				
					if (strlen($message) <= $position){
						echo $message;
					} else {
						$post = substr($message, 0, $position); 
						echo $post;				
				?>
						<a id="link" href ="<?php echo $this->request->base?><?php echo $notice['Node']['path'];?>">Read More>></a>
						
					<?php } ?>				
            </p>                              
      <?php endforeach ; ?>
    </div>

</body>
</html>