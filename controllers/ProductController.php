<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use app\models\Category;

class ProductController extends Controller
{
	
	public function actionIndex()
	{
		$query = Product::find()
			->select('p.*,c.name as cat_name')
			->from('product p')
			->leftJoin('category c','p.category_id = c.category_id');
		$product = $query->asArray()->all();
		return $this->render('index', ['query'=> $query, 'model'=> new Product()]);
	}
	
	public function actionAdd()
	{
		$model = new Product();
		$model->load(Yii::$app->request->post());
		$product = Yii::$app->request->post('Product');
		$category_id = $product['category_id'];
		if ( $model!=null && $category_id!=null ) {
			$model->category_id = $category_id;
			$model->created_at = date("Y-m-d H:i:s");
			$model->save();
		}
		return $this->redirect(['/product/index']);
	}
	
	public function actionDelete()
	{
		$product = Product::findOne(Yii::$app->request->get('id'));
		if ( $product!=null )
		{
			$product->delete();
		}
		return $this->redirect(['/product/index']);
	}
}

?>