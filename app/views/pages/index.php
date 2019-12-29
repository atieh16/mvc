<?php
  
  include_once VIEWROOT."inc/head.php"; 
  include_once VIEWROOT."inc/header.php"; 
  echo 'welcome to pages/index';
  die();

?>


  <div class="slider-item overlay" data-stellar-background-ratio="0.5"
    style="background-image: url('http://localhost/mvc/public/assets/images/hero_2.jpg');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center">
        <div class="col-lg-9 text-center col-sm-12 element-animate">
          <h1 class="mb-4">ما آژانس خلاقی هستیم</h1>
          <div class="btn-play-wrap mx-auto">
            <p class="mb-4"><a href="https://www.youtube.com/watch?v=_VnYSoMI-9Q" data-fancybox data-ratio="2"
                class="btn-play"><span class="ion ion-ios-play"></span></a></p>
          </div>
          <span>بازدید ویدیو</span>

        </div>
      </div>
    </div>
  </div>

  

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                      <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped mytable">

                          

                                        <thead>
                                        <th>عنوان</th>
                                        <th>توضیحات</th>
                                        <th>عکس</th>
                                        <th>تاریخ</th>
                                        </thead>
                                        <tbody>
                             <?php
                                if(isset($data['posts']))
                                  foreach ($data['posts'] as $key => $value) {
                                
                              ?>
                                        
                                                <tr>
                                                    <td><?= $value->title ?></td>

                                                    <td>
                                                        <?php
                                                        $value->content = strip_tags($value->content);
                                                        $value->content = substr($value->content,0,100);
                                                        echo $value->content."[....]";
                                                        ?>
                                                    </td>

                                                    <td style="width: 40%;"><img style="width:20%;" src="<?= UPLOADURL.$value->image ; ?>"></td>
                                               
                                                    
                                                    <td><?= $value->date ?></td> 

                                                    <td>
                                                         <!-- address haye ma ba estefade az .htaccess pretty link shodeand va digar addressi be sorat localhost/mvc/delete&id=2 nadarim balke address ha be sorat localhost/mvc/delete/2 taghir yafte and va 2 ,.... be onvan parameters be method delete ersal mishavadnd-->
                                                          <a href="<?=SITEURL?>pages/delete/<?= $value->id ?>"><img src="https://img.icons8.com/material-rounded/24/000000/delete-sign.png"></a>
                                                                      
                                                          <a href="<?=SITEURL?>pages/edit/<?= $value->id ?>"><img src="https://img.icons8.com/material-rounded/24/000000/update-left-rotation.png"></a>
                                                                      

                                                    </td>                                            
                                                </tr>
                              <?php
                                    }
                              ?>                  
                                            

                                        </tbody>
                                    </table>

                           <div class="pull-left col-md-5 text-left add">
                                <a class="btn btn-primary" href="<?= SITEURL?>pages/add"><img src="https://img.icons8.com/small/16/000000/plus.png">افزودن</a>
                            </div>

                              </div>
                          </div>
                       </div>
                     </div>
                  </div> 
               </div>

 
  

  <?php
    include_once VIEWROOT."inc/footer.php";
  ?>

 
