<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use budyaga\users\models\User;


class SiteController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','changepass'],
                'rules' => [
                    [
                        'actions' => ['logout','changepass'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

     /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('index');
    }
    

    public function actionChangepass(){
        $error=null;
        $message=null;
        
        if(Yii::$app->request->post('change')!=null){
            $pass = Yii::$app->request->post('password');
            $confirm = Yii::$app->request->post('confirm');
            if($pass==null||trim($pass)==''||$confirm==null||trim($confirm)==''){
                $error = "Пароль и подтверждение не могут быть пустыми";
            }else if(trim($pass)!=trim($confirm)){
                $error = "Пароль и подтверждение должны совпадать";
            }else{
                $us=User::findOne(Yii::$app->user->identity->id);
                if($us!=null){
                    $us->setPassword($pass);
                    if($us->save()){
                        $message="Пароль успешно обновлен";
                    }else{
                        $error = "Невозможно обновить пароль";
                    }
                }
            }
            
            
        }
        
        
        
        
        return $this->render('form',['error'=>$error,'message'=>$message]);
    }

}
