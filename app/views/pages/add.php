<?php
 
 if(isset($data['posts']))
 {
    $post = $data['posts'];

 }


include VIEWROOT . "inc/admin/head.php";

?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                         
                     <a class="btn btn-dark col-md-2 exit-btn" href="<?=SITEURL?>pages/index" title="خروج">بازگشت به صفحه ی اصلی</a>
               

                        <?php

                        if(isset($data['message'])){

                            $message = $data['message'];

                            switch ($message) {
                                case 'ok':

                                    $message = "با موفقیت انجام شد";
                                    $class = "text-success";

                                    break;

                                case 'nokay':

                                    $message = "خطایی رخ داده است";
                                    $class = "text-danger";

                                    break;   

                                default:

                                    break;
                            }

                            echo "<h4 class='{$class}' >{$message}</h4>";


                        }

                        ?>

                        <div class="card-header">
                            <h4 class="card-title">
                            <?php
                               if(isset($post)){
                            ?>    
                            ویرایش مطالب
                            <?php
                        }else{
                            ?>
                            افزودن مطالب
                            <?php
                          }
                            ?>
                          </h4>
                        </div>
                        <div class="card-body">

                             
                        <form  method="post" action="<?= SITEURL.("pages/") . ((isset($post))? 'update' : 'save') ; ?>" enctype="multipart/form-data"> 

                             <div class="row">
                                    <div class="col-md-5 pr-1">
                                        <div class="form-group">
                                             <label>عنوان</label>
                                            <input name="title" type="text" class="form-control" placeholder="عنوان"
                                                   value="<?= (isset($post))? $post[0]->title : '' ; ?>">
                                        </div>
                                    </div>
                                </div>



                                <?php
                                if(isset($post)) {
                                    ?>

                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <img style="width: 50%" src="<?= UPLOADURL . $post[0]->image; ?>">
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="<?=$post[0]->id;?>">

                                    <?php
                                }
                                ?>


                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>عکس</label>
                                            <input name="pic" type="file" class="form-control"  value="">
                                        </div>
                                    </div>
                                </div>

                               
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>برچسب ها</label>
                                            <select class="cat-select form-control" name="tags[]" multiple="multiple">
                                                <?php

                                                foreach ($data['tags'] AS $tag) {
                                                    ?>
                                                    <option value="<?= $tag->id ?>"

                                                        <?php
                                                        if(isset($data['poststags']) )
                                                            foreach ($data['poststags'] as $poststags)
                                                                if($poststags->tag_id == $tag->id)
                                                                    echo "selected";
                                                        ?>

                                                    ><?= $tag->subject; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                              

                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>دسته بندی ها</label>
                                            <select class="cat-select form-control" name="categories[]" multiple="multiple">
                                                <?php

                                                     foreach ($data['categories'] AS $category) {


                                                         ?>
                                                         <option value="<?= $category->id; ?>"

                                                             <?php
                                                             if(isset($data['posts_categories']))
                                                                 foreach ($data['posts_categories'] as $postCategory)
                                                                     if($postCategory->cat_id == $category->id)
                                                                         echo "selected";
                                                             ?>

                                                         ><?= $category->title; ?></option>
                                                         <?php
                                                     }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                             
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>توضیحات</label>
                                            <textarea name="content" rows="4" cols="80" class="form-control" placeholder="" value=""
                                            ><?= (isset($post))? $post[0]->content : '' ; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button  type="submit" name="<?= (isset($post))? 'edit-post' : 'add-post' ; ?>" class="btn btn-info btn-fill pull-right">
                                    <?php
                                    if(isset($post)) {
                                        ?>
                                        ویرایش
                                        <?php
                                    }else {
                                        ?>
                                        افزودن
                                        <?php
                                    }
                                    ?>
                                </button>
                               
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script>

    $(document).ready(function(){

        $('#tags-input').tagsinput();
        $('.cat-select').select2();


    });
 </script>


<?php
include VIEWROOT . "inc/admin/footer.php";

?>


