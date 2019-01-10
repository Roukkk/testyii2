<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'Статьи';

if( Yii::$app->session->hasFlash('success') )
{
	echo '<div class="alert alert-success alert-dismissible" role="alert">';
	echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	echo Yii::$app->session->getFlash('success');
	echo '</div>';
}

if( Yii::$app->session->hasFlash('error') )
{
	echo '<div class="alert alert-danger alert-dismissible" role="alert">';
	echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	echo Yii::$app->session->getFlash('error');
	echo '</div>';
}

	$form = ActiveForm::begin([
				'action'=>['post/add'],
				'options' => ['enctype' => 'multipart/form-data', 'id' => 'post']
			]);
		echo $form->field($model, 'name');
		echo $form->field($model, 'email');
		echo $form->field($model, 'text')->textarea(['rows' => 5]);
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

			['label'=>'id Поста',
				'format' => 'raw',
				'value'=>function ( $data ){
					return $data[ 'post_id' ];
					
					}
					
			],
			['label' => 'Название',
				'format' => 'raw',
				'value'=>function ( $data ){
						return Html::textInput( 'name', $data[ 'name' ],
						[ 'class' => 'form-control requestname', 'style' => 'border-width: 2px', 'id' => $data[ 'post_id' ] ] );
					}
					
			],
			['label'=>'E-mail',
				'format' => 'raw',
				'value'=>function ( $data ){
						return Html::textInput( 'email', $data[ 'email' ],
						[ 'class' => 'form-control requestmail', 'style' => 'border-width: 2px', 'id' => $data[ 'post_id' ] ] );
					}
					
			],
			['label'=>'Текст поста',
				'format' => 'raw',
				'value'=>function ( $data ){
						return Html::textInput( 'text', $data[ 'text' ],
						[ 'class' => 'form-control requesttext', 'style' => 'border-width: 2px', 'id' => $data[ 'post_id' ] ] );
					}
					
			],
			['label'=>'',
				'format' => 'raw',
				'value'=>function ( $data ){
					return Html::a('',[ '/post/delete', 'id' => $data[ 'post_id' ] ],[ 'class' => 'glyphicon glyphicon-trash' ] );
					
					}
					
			],
			
		]

	]);
?>