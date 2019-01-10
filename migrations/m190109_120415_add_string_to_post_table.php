<?php

use yii\db\Migration;

/**
 * Class m190109_120415_add_string_to_post_table
 */
class m190109_120415_add_string_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->insert('post', [
			'name' => 'Andrew',
			'email' => 'Slowpoke159@gmail.com',
			'text' => 'Alooou',
			'position' => '3',
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->delete( 'post', ['post_id' => 29]);
    }
}
