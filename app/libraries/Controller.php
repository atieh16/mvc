<?php

 class Controller{

    public function __construct()
    {
    	#my code for __construct function
    }
   
    protected function view($path,$data = []){
    	if(file_exists(APP_ROOT . "views/".$path.".php")){
    		require_once APP_ROOT . "views/". $path . ".php";
    	}else{
    		die("View {$path} Not Found");
    	}
    }

    protected function model($modelName){

    	if(file_exists(APP_ROOT . "models/".ucwords($modelName).".php")){
    		require_once APP_ROOT . "models/" . ucwords($modelName).".php";
    		$modelName = ucwords($modelName);
    		$model = new $modelName ;
    		return $model;
    	}else{
    		die("Model {$modelName} Not Found");
    	}
    }

  
 }