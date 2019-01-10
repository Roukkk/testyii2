<?php
$this->title = 'Категории';
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


$form = ActiveForm::begin([
				'action'=>['category/add'],
				'options' => ['enctype' => 'multipart/form-data', 'id' => 'category']
			]);
	echo $form->field( $model, 'name' );
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

		['label'=>'id Категории',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'category_id' ];
				
				}
				
		],
		['label'=>'Название',
			'format' => 'raw',
			'value'=>function ( $data ){
				return $data[ 'name' ];
				
				}
				
		],
		['label'=>'',
			'format' => 'raw',
			'value'=>function ( $data ){
				return Html::a('',[ '/category/delete', 'id' => $data[ 'category_id' ] ],[ 'class' => 'glyphicon glyphicon-trash' ] );
				
				}
				
		],
		
	]
	
]);
?>