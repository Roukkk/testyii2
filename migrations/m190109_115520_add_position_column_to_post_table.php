<?php

use yii\db\Migration;

/**
 * Handles adding position to table `post`.
 */
class m190109_115520_add_position_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn( 'post', 'position', $this->integer() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropColumn( 'post', 'position' );
    }
}
