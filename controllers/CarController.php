<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Car;

class CarController extends Controller{
	
	public function actionIndex()
	{
		$query = Car::find();
		$car = $query->asArray()->all();
		return $this->render( 'index', [ 'query' => $query, 'model' => new Car() ] );
	}
	
	public function actionAdd()
	{
		$model = new Car();
		$model->load(Yii::$app->request->post());
		if ( $model!=null )
		{
			$model->created_at = date("Y-m-d H:i:s");
			$model->save();
		}
		return $this->redirect( [ '/car/index' ] );
	}
	
	public function actionDelete()
	{
		$car = Car::findOne(Yii::$app->request->get('name'));
		if ( $car!=null ) 
		{
			$car->delete();
		}
		return $this->redirect( [ '/car/index' ] );
	}	
}
?>