<?php
 require_once "helpers/constants.php";
 require_once "helpers/function_helper.php";
 

  spl_autoload_register(function($classname){

    if(file_exists(APP_ROOT."libraries/".ucwords($classname).".php"))
    	require_once APP_ROOT."libraries/".ucwords($classname).".php";

  }); 	


  spl_autoload_register(function($className){

	if(file_exists(APP_ROOT . "controllers/" . ucwords($className) . ".php"))
		require_once APP_ROOT . "controllers/" . ucwords($className) . ".php";


});

 

