<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Connection;

class Test extends ActiveRecord{	

	public function rules(){ 
        return [
            [['name','create_date','user_id'],'required','message'=>'Передайте параметры'],	
            [['test_id'],'filter','filter'=>'trim'],
			
        ]; 
    }
	
    
	
}