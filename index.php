<?php 
    $view = true;
	include './core/core.php';
 	if($mod){
 		if(file_exists('view/'.$mod.'.php')){
			include 'view/'.$mod.'.php';
		}else{
			exit('<script>alert("功能未启用");location="/";</script>');
		}
 	}else{
 		include 'view/index.php';	
 	}
 ?> 
