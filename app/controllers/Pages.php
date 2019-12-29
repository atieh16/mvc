<?php

class Pages extends Controller
{

	public function __construct()
	{   
		$this->pageModel = $this->model('page');
        $this->catmodel = $this->model('category');
        $this->tagmodel = $this->model('tag');
        $this->postCatmodel = $this->model('postcategory');
        $this->postTagmodel = $this->model('posttag');

	}
    
    // public function index(indexRequest $request , indexRequest $request2)
	public function index($request ,$request2)
	{
         
         // echo '$request->id :'. $request->id."<br>".'$request->name :'.$request->name."<br>";
        echo '$request->id :'. $request."<br>".'$request->name :'.$request2."<br>";
         // $posts = $this->pageModel->select('posts');
         // $data =[
         // 	'posts' => $posts
         // ];

         // $this->view('pages/index' , $data);
         $this->view('pages/index');

	}

   
	public function delete(deleteRequest $request)
	{
         
        // if(!$id || !is_numeric($id))
		if(!$id){
            
			header("location:" . SITEURL . "pages/index");
			die();
		}

		$this->pageModel->delete('posts' , 'id = :id ' , ['id' => $id] );
		header("location:" . SITEURL . "pages/index");

	}

	public function add(){
         
         $categories = $this->catmodel->select('categories');
         $tags = $this->tagmodel->select('tags');
         $data = [
         	'categories' => $categories,
         	'tags' => $tags
         ];

         $this->view('pages/add' , $data);
	}

	public function save(){

		if(post('add-post' , true))
		{  

             $data = [
             	"title" => $_POST['title'],
             	"content" => $_POST['content'],
             	"user_id" => 48,
             	"confirm" => 2     	
             ];
             $data["image"] = UploadImage();
             
             $result = $this->pageModel->add('posts', $data);

             
             $postId = $this->pageModel->lastId();
             
             

             $data = [
              
               "post_id" => $postId
             ];            

             foreach ($_POST['categories'] as $key => $value) {
             	$data['cat_id'] = $value;
             	$this->postCatmodel->add('posts_categories' , $data);
             }
             


             $data = [
              
               "post_id" => $postId
             ]; 

             foreach ($_POST['tags'] as $key => $value) {
             	 $data['tag_id'] = $value;
             	 $this->postTagmodel->add('posts_tags' , $data);
             }

             $message = "";
             if($result)
             {
             	$message = "ok";
             }else{
             	$message = "nokay";
             }
         }

         $categories = $this->catmodel->select('categories');
         $tags = $this->tagmodel->select('tags');
         $data = [
         	'categories' => $categories,
         	'tags' => $tags,
         	'message' => $message
         ];

         $this->view('pages/add' , $data);
		
	}

  //parameter id be method edit ersal mishavad (address ha be sorat :localhost/mvc/edit/2 hatsand)
    public function edit($id){
        // if(!$id || !is_numeric($id))
        if(!$id){

            header("location:" . SITEURL . "pages/index");
            die();
        }

        
        $posts = $this->pageModel->select('posts' , 'id = :id' , ['id' => $id]);;   

        if($posts === false){
            header("location:" . SITEURL . "pages/index");
            die();
        }


        $categories = $this->catmodel->select('categories');
        $tags = $this->tagmodel->select('tags');
        $postsCategories = $this->postCatmodel->select('posts_categories' , 'post_id = :post_id' , ['post_id' => $id]);
        $poststags = $this->postTagmodel->select('posts_tags' , 'post_id = :post_id' , ['post_id' => $id]);
        $data = [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'posts_categories' => $postsCategories,
            'poststags' => $poststags
         ];
         $this->view('pages/add' , $data);
    }


    public function update()
    {

        if(post('edit-post' , true)){

            $data = [
              "title" => $_POST['title'],
              "content" =>$_POST['content'] ,
              'id' => $_POST['id']
            ];

            if(isset($_FILES['pic']) AND !empty($_FILES['pic']['name'])){

                $data['image'] = UploadImage();
            }


            $result = $this->pageModel->update('posts' , $data);


            $data =[
                'post_id' => $_POST['id']
            ];
    
           
            $this->postCatmodel->delete('posts_categories' , 'post_id = :post_id' , ['post_id' => post('id')]);

            foreach ($_POST['categories'] as $key => $value) {
                   $data['cat_id'] = $value;
                   $this->postCatmodel->add('posts_categories' , $data);
             } 


            $data =[
                'post_id' => $_POST['id']
            ];  

            $this->postTagmodel->delete('posts_tags' , 'post_id = :post_id' , ['post_id' => post('id')]);

            foreach ($_POST['tags'] as $key => $value) {
                 $data['tag_id'] = $value;
                 $this->postTagmodel->add('posts_tags' , $data);
            }

            if($result)
            {
                $message = "ok";
            }else{
                $message = "nokay";
            }

            $posts = $this->pageModel->select('posts' , 'id = :id' , ['id' => post('id')]);
            
            if($posts === false){

                header("location:" . SITEURL . "pages/index");
                die();
            }


        $categories = $this->catmodel->select('categories');
        $tags = $this->tagmodel->select('tags');
        $postsCategories = $this->postCatmodel->select('posts_categories' , 'post_id = :post_id' , ['post_id' => post('id')]);
        $poststags = $this->postTagmodel->select('posts_tags' , 'post_id = :post_id' , ['post_id' => post('id')]);
        $data = [
            'posts' => $posts,
            'message' => $message,
            'categories' => $categories,
            'tags' => $tags,
            'posts_categories' => $postsCategories,
            'poststags' => $poststags
         ];

        $this->view('pages/add' , $data);



        }
    }
	
   
}
 