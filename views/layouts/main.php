<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/icon.png" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    
    //Пользователи
	$users="";
	if(Yii::$app->user->can('rbacManage')){
		$users='<li>'.Html::a('Пользователи',['/user/admin']).'</li>';
	} 
	//права
	$rights="";
	if(Yii::$app->user->can('rbacManage')){
		$rights='<li>'.Html::a('Права',['/user/rbac']).'</li>';
	}
    //Настройки
	$settings="";
	if(Yii::$app->user->can('settings')){
		$settings='<li>'.Html::a('Тесты',['/test/index']).'</li>';
	}
	
	$posts="";
	if(!Yii::$app->user->isGuest){
		$posts='<li>'.Html::a('Посты',['/post/index']).'</li>';
	}
	
	$category="";
	if(!Yii::$app->user->isGuest){
		$category='<li>'.Html::a('Категории',['/category/index']).'</li>';
	}
	
	$product="";
	if(!Yii::$app->user->isGuest){
		$product='<li>' . Html::a('Продукты', ['/product/index']) . '</li>';
	}
	
	$car="";
	if(!Yii::$app->user->isGuest){
		$car='<li>' . Html::a('Машины', ['/car/index']) . '</li>';
	}
	
	$changePass='<li>'.Html::a('Сменить пароль',['/site/changepass']).'</li>';
	if(Yii::$app->user->isGuest){
		$login='<li>'.Html::a('Вход',['/login']).'</li>';
	}else{
		
	$login='<li class="dropdown" id="settingsdrop">
		<a href="#" class="dropdown-toggle keep_open"  data-toggle="dropdown" >'.Yii::$app->user->identity->username.'</a>
		<ul class="dropdown-menu keep_open" id="settings">
			<li>'.Html::a('Выход',['/logout']).'</li> 
			'.$changePass.'
			<li class="divider"></li> 
			'.$users.'
			'.$rights.'    
			<li class="divider"></li>
			'.$settings.'
			'.$posts.'
			'.$category.'
			'.$product.'
			'.$car.'
		</ul> 
	</li>';			
	
	}
	

	echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
			$login,	 	
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
