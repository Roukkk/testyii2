<?php 
$this->title = 'Статья'; 
use app\components\MyWidget;
/*foreach ( $category as $cat )
{
	echo'<ul>';
		echo '<h1>' . $cat->name . '</h1>';
		foreach ( $cat->products as $product )
		{
			echo '<ul>';
				echo '<h4>' . $product->name . '</h4>';
			echo '</ul>';
		}
	echo'</ul>';
}*/




//echo MyWidget::widget( [ 'name' => 'Вася' ] ); 

	MyWidget::begin();?>
	<h1>привет, мир!!!</h1>
   
	<?php MyWidget::end();?>

