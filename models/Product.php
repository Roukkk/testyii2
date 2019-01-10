<?php
namespace app\models;

use Yii;
use yii\db\Connection;
use yii\db\ActiveRecord;


class Product extends ActiveRecord{
	
	public function attributeLabels()
	{
		return [
			'product_id' => 'Номер продукта',
			'name' => 'Название',
			'category_id' => 'Категория',
			'created_at' => 'Время добавления',
		];
	}
	
	public function rules()
	{
		return [
			[ [ 'name' ], 'required', 'message' => "Передайте параметры"],
		];
	}
	
	
	
}

?>