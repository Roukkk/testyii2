<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Car;

$form = ActiveForm::begin([
	'action' => ['car/add'],
	'options' => ['enctype' => 'multipart/form-data', 'id' => 'car']
	]);
	echo $form->field($model, 'name')->label('Название');
	echo $form->field($model, 'seats')->label('Количество мест');
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

		['label'=>'Название',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'name' ];
				
				}
				
		],
		['label'=>'Количество мест',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'seats' ];
				
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
				return Html::a('',[ '/car/delete', 'name' => $data[ 'name' ] ],[ 'class' => 'glyphicon glyphicon-trash' ] );
				
				}
				
		],
		
	]

]);




?>