<?php
namespace app\models;

use yii\db\Connection;
use yii\db\ActiveRecord;

class Car extends ActiveRecord{
	
	public function attributeLabels()
	{
		return [
			'name' => 'Название',
			'seats' => 'Количество мест',
			'datetime' => 'Время добавления',
		];
	}
	
	public function rules()
	{
		return[
			[ [ 'name', 'seats' ], 'required', 'message' => "Передайте параметры"],
		];
	}
}


?>