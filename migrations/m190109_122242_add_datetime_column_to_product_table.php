<?php

use yii\db\Migration;

/**
 * Handles adding datetime to table `product`.
 */
class m190109_122242_add_datetime_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn( 'product','datetime', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropColumn( 'product', 'datetime' );
    }
}
