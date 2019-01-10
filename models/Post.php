<?php
namespace app\models;

use yii\db\Connection;
use yii\db\ActiveRecord;

class Post extends ActiveRecord{
	
	public function attributeLabels()
	{
		return [
			'name' => 'Название',
			'email' => 'E-mail',
			'text' => 'Текст сообщения',
		];
	}
	
	public function rules()
	{
		return[
			[ 'email', 'email' ],
			[ [ 'name', 'text'], 'required', 'message' => "Передайте параметры"],
			[ [ 'name', 'email', 'text'],'filter', 'filter' => "trim"],
		];
	}
}


?>