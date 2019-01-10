<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller{
	
	
	public function actionIndex($id = null){
		$hi = 'Hello World';
		$names = ['Ivanov','Petrov','Sidorov'];
		
		if(!$id){
			$id = 'test';
		}
		
		return $this->render('index',['hi'=>$hi,'names'=>$names,'id'=>$id]);
	}
	
	
	public function actionBlogPost(){
		return '<h1>Blog Post</h1>';
		
	}
	
	
	
}



?>