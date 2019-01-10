<?php
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
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
		<ul class="nav nav-pills">
		  <li role="presentation" class="active"><?= Html::a('Главная',['/']); ?></li>
		  <li role="presentation"><?= Html::a('Статьи',['/post/index']); ?></li>
		  <li role="presentation"><?= Html::a('Статья',['/post/show']); ?></li>
		</ul>
	
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
