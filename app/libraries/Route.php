 <?php

 Class Route{

   
    private static $routeQueue;
    private static $request;


   
    public function __construct(){

        self::$request = new Request; 

    }


    public static function post($pattern , $invokes){


        if(self::$request->httpRequest == 'POST'){

           self::handle($pattern , $invokes);
           /*$routeQueue[$pattern] = $invokes;*/
           /*agar khastim az $routeQueue estefade konim aslan nabayad handle inja farakhani shavad va dar inja faghat khat code
             $routeQueue[$pattern] = $invokes; mibashad va sepas vared Queue mishavim va bad handle ra farakhani mikonim ke ma felan az inravesh estefade nakardim*/

           /*tafavot raveshi ke rafim ba ravesh Queue dar in ast ke dar ravesh feli ma tak tak pattern ha ra barrasi karde va be soragh pattern dadi miravim ama dar ravesh Queue hameye pattern ha dar saf ghara migirad va sepash barrasi mishavad*/  

        }
    }


    public static function get($pattern , $invokes){
        
        if(self::$request->httpRequest == 'GET'){

           self::handle($pattern , $invokes);
           //$routeQueue[$pattern] = $invokes;
        }
    }


    public static function handle($pattern , $invokes){

         $patternArray = explode('/' , $pattern);
         // $urlArray = explode('/' , rtrim($_GET['url'] . '/'));
         $urlArray = explode('/' , self::GetUrl());


       

         preg_match_all('#\{\w+\}#', $pattern , $matches , PREG_OFFSET_CAPTURE | PREG_SET_ORDER); 
        
          // echo "<pre>";
         /*placeholder: sign {?([^\/}]+)}? moshabeh placeholder amal mikonad moshabeh : ke dar pdo ghara midadim ke be jaye query ha : migozashtim*/ 
         $makeP = preg_replace('#\{\w+\}#' , '{?([^\/}]+)}?' , $pattern);
  

         if(preg_match("~$makeP$~" , $_GET['url'])){
                      
              $i = 0;   
              foreach ($patternArray as $value) {
                 
                  if($urlArray[$i] == $value){
                      unset($urlArray[$i]);
                  }
                  $i++;
              }
              $urlArray = array_values($urlArray);
              

              $i = 0;
              foreach($matches as $key => $matche){

                  $matche[0][0] = trim($matche[0][0] , "{");
                  $matche[0][0] = trim($matche[0][0] , "}");
                
                  // alan $matche[0][0] yek property class Request mishavad chon self::$request yek object az class Request ra darad
                  self::$request->{$matche[0][0]} = $urlArray[$i++];       
              }


              $invokesArray = explode("@" , $invokes);
              if(!empty($invokesArray[0]))
                 self::$request->currentController = $invokesArray[0];
              if(!empty($invokesArray[1]))
                 self::$request->currentAction = $invokesArray[1];


               self::$request->invoke();
         }

    }
    


   
    public static function GetUrl(){

     if(!empty($_GET['url'])){
          
          $url = $_GET['url'];
          $url = rtrim($url , '/');
          // $url = explode('/',$url);
          return $url;
        }
    }



 }









 