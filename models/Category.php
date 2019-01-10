<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Connection;

class Category extends ActiveRecord{
	
	public function attributeLabels()
	{
		return [
			'category_id' => 'Номер категории',
			'name' => 'Название',
		];
	}
	
	public function rules()
	{
		return [
			[ [ 'name', ], 'required', 'message' => "Передайте параметры"],
		];
	}
	
}
?>