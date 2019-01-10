<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use app\models\Category;
use app\models\Product;

class PostController extends Controller{
	
	public $layout = 'basic';
	
	public function actionIndex()
	{
		$model = new Post();

		if( $model->load(Yii::$app->request->post()) )
		{
			if( $model->validate() )
			{
				Yii::$app->session->setFlash('success', 'Данные приняты');
				return $this->refresh();
			}
			else
			{
				Yii::$app->session->setFlash('error', 'Данные отклонены');
			}
		}
		
		$query = Post::find();
		$post = $query->asArray()->all();
		
		return $this->render('index', ['model'=>$model, 'query' => $query ]);
	}
	
	public function actionShow()
	{
		$this->view->registerMetaTag([
		    'name' => 'keywords',
			'content' => 'Ключевые фразы'
		]);
		$this->view->registerMetaTag([
			'name' => 'description', 
			'content' => 'Описание страницы'
		]);

		$category = Category::find()->with('products')->all();
		
		
		return $this->render('show', [ 'category' => $category ]);	
	}
	
	public function actionAdd()
	{
		$post = new Post();
		$post->load(Yii::$app->request->post());
		if ( $post->validate() )
		{
			$post->save();
		}
		else
		{
			return print_r($post->getErrors());
		}
		return $this->redirect(['post/index']);
	}
	
	public function actionDelete()
	{
		$id = Yii::$app->request->get('id');
		if ( $id!=null )
		{
			$model = Post::findOne($id);
			$model->delete();
		}
		return $this->redirect(['/post/index']);
	}
	
	public function actionUpdatename()
	{
		$post = Post::findOne(Yii::$app->request->post('id'));
		if ( $post!=null )
		{
			$post->name = Yii::$app->request->post('name');
			$post->save();
		}
		return Post::findOne(Yii::$app->request->post('id'))->name;
	} 
	
	public function actionUpdatemail()
	{
		$post = Post::findOne(Yii::$app->request->post('id'));
		if ( $post!=null )
		{
			$post->email = Yii::$app->request->post('email');
			$post->save();
		}
		return Post::findOne(Yii::$app->request->post('id'))->email;
	}
	
	public function actionUpdatetext()
	{
		$post = Post::findOne(Yii::$app->request->post('id'));
		if ( $post!=null )
		{
			$post->text = Yii::$app->request->post('text');
			$post->save();
		}
		return Post::findOne(Yii::$app->request->post('id'))->text;
	} 	
}
?>