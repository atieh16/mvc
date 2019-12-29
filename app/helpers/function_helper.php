<?php

 function UploadImage(){

          $target_dir =PATH_ROOT."public/assets/uploads/";
          $fileName = $_FILES['pic']['name'];
          $fileName = pathinfo($fileName , PATHINFO_FILENAME) .time(). "." .pathinfo($fileName ,   PATHINFO_EXTENSION);
          $fullPath = $target_dir . $fileName;


          if (!move_uploaded_file($_FILES['pic']['tmp_name'], $fullPath)) {
 
              die("انتخاب عکس الزامی است");
          }
          return $fileName;
}


 function post ($key , $empty = false)
 {


     if($empty == true AND isset($_POST[$key])){

         return true;
     }


     if(isset($_POST[$key]) AND $empty == false AND !empty($_POST[$key])) {
         return $_POST[$key];
     }

     return false;
 }

  function get ($key , $empty = false)
 {
    
    if($empty == true AND isset($_GET[$key]) AND !empty($_GET[$key]))
    {
        return true;
    }
     
     if(isset($_GET[$key]) AND $empty == false) {
         return $_GET[$key];
     }
     return false;
 }
 ?>
