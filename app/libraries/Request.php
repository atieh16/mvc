<?php

  class Request{

  	private $currentController = 'Pages';
  	private $currentAction = 'index';
  	public $params = [];
  	private $httpRequest;



  	public function __construct(){

  		$this->httpRequest = $_SERVER['REQUEST_METHOD'];
  	}


  	public function __get($property){

  		if(property_exists($this ,$property))
  			return $this->$property;

  		return false;
  	}

    
    public function __set($property , $value){

    	// if(property_exists($this , $property))
    	
    		$this->$property = $value;

    	// return false;
    }

    public  function invoke(){

      $reflec = new ReflectionClass($this->currentController);
      $Method = $reflec->getMethod($this->currentAction);
      // $NumsOfFunctionMethods = $Method->getNumberOfParameters();
      $MethodParams = $Method->getParameters();
      /* masalan agar method ma index bashad va parameter on (indexRequest $request) getparameters() $request ra bar migardanad*/


      // for($i = 0 ; $i < count($MethodParams) ; $i++){
      //   $typeparam[$i] = (string)$MethodParams[$i]->name->getType();
      //   var_dump($typeparam);
      //   die();
      // }
         
        //  $param = new ReflectionParameter(array('ExampleController', 'PostMaterial'), 0);

        // //Echo the type of the parameter
        // echo $param->getClass()->name;
    
        
      // $method_reflection = new ReflectionMethod($this->currentController, $this->currentAction);

      // foreach( $method_reflection->getParameters() as $reflection_parameter )
      // {
      //     $type = $reflection_parameter->getType();
        
      // }
      //   var_dump($type);
      //     die();
   

    	if(file_exists(REQUESTS_ROOT . $this->currentController . "Request.php")){

    		//$this->customRequest = new $this->currentController."Request";
    	}



      $request = $this;

      

      if($request !== $this){

        if(function_exists([$request , 'rules'])){

          if($rules = $request->rules()){

            foreach ($rules as $key => $value) {

              $ruleArray = exploade('|' , $rules[$key]);
              if(!empty($request->params[$key])){

                
                if(!empty($ruleArray[0])){
                  //Required
                }
                if(!empty($ruleArray[1])){
                  //type check

                }
                $request->{$key} = $value;
                unset($rules[$key]);


              }elseif(empty($ruleArray[0])){

                unset($rules[$key]);
              }
              


            }
            if(count($rules) > 0 ){
              //error
              die();
            }

              




          }


        }

        
      }

    	$this->currentController = new $this->currentController;

    	call_user_func_array([$this->currentController,$this->currentAction], [$this]);


    }

  }