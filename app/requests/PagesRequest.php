<?php
 class PagesRequest{

 	private $id;
 	private $name;
 	private $lastname;

 	function rules(){

 		return [
 			'id' => "required|int" ,
 			'name' => "required |string",
 			'lastName' =>"|string"
 		];
 	}
 }