<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;

$items = ArrayHelper::map(Category::find()->asArray()->all(),'category_id','name');

$form = ActiveForm::begin([
	'action' => ['product/add'],
	'options' => ['enctype' => 'multipart/form-data', 'id' => 'post']
	]);
	echo $form->field($model, 'name')->label('Название продукта');
	echo $form->field($model, 'category_id')->dropDownList($items)->label(false);
	echo Html::submitButton('Отправить', ['class' => 'btn btn-success']);
ActiveForm::end();


$dataProvider = new ActiveDataProvider([
		'query' => $query,
		'pagination' => false,
	]);

echo GridView::widget([ 
	'dataProvider' => $dataProvider, 
	'showHeader'=>true,
	'tableOptions' => [
		'class' => 'table table-striped table-bordered'
	],
	'columns' => [ 

		['label'=>'Номер продукта',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'product_id' ];
				
				}
				
		],
		['label'=>'Название категории',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'cat_name' ];
				
				}
				
		],
		['label'=>'Название продукта',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'name' ];
				
				}
				
		],
		['label'=>'Время добавления',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'created_at' ];
				
				}
				
		],
		['label'=>'',
			'format' => 'raw',
			'value'=>function ( $data ){
				return Html::a('',[ '/product/delete', 'id' => $data[ 'product_id' ] ],[ 'class' => 'glyphicon glyphicon-trash' ] );
				
				}
				
		],
		
	]

]);




?>