<?php
namespace app\components;

use yii\base\Widget;

class MyWidget extends Widget{
	
	public $name;
	
	public function init()
	{
		parent::init();
		/*if ( $this->name === null )
		{
			$this->name = 'Гость';
		}*/
		
		ob_start();
	}
	
	public function run() 
	{
		$content = ob_get_clean();
		$content = mb_strtoupper($content);
		
		return $this->render('my', ['content' => $content ]);
	}
	
	
	
}

?>