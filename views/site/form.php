<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


    

    echo '<div class="col-lg-6 col-lg-offset-3">';

    echo '<h3>Смена пароля</h3>';
    
    if($error!=null){
        echo '<div class="col-lg-12 panel panel-danger">'.$error.'</div>';
    }
    if($message!=null){
        echo '<div class="col-lg-12 panel panel-success">'.$message.'</div>';
    }
    
    $form = ActiveForm::begin(['action' =>['/site/changepass'],'options' => ['class' => '']]);
	
    echo Html::passwordInput('password',null,['class' => 'form-control','placeholder'=>'пароль','style'=>'margin-top:10px;']);
    echo Html::passwordInput('confirm',null, ['class' => 'form-control','placeholder'=>'подтверждение','style'=>'margin-top:10px;']);
    echo Html::submitButton('Обновить', ['class' => 'btn btn-primary', 'value'=>'1','name' => 'change','style'=>'margin-top:10px;']);
    
    ActiveForm::end(); 

    echo '</div>';



?>