<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;

class CategoryController extends Controller{
	
	public function actionIndex()
	{
		$query = Category::find();
		$category = $query->asArray()->all();
		return $this->render( 'index', [ 'query' => $query, 'model' => new Category() ] );
	}
	
	public function actionAdd()
	{
		$model = new Category();
		$model->load(Yii::$app->request->post());
		if ( $model!=null )
		{
			$model->save();
		}
		return $this->redirect( [ '/category/index' ] );
	}
	
	public function actionDelete()
	{
		$category = Category::findOne(Yii::$app->request->get('id'));
		if ( $category!=null ) 
		{
			$category->delete();
		}
		return $this->redirect( [ '/category/index' ] );
	}
	
	
	
	
	
	
}



?>