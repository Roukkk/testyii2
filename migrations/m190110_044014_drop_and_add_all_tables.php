<?php

use yii\db\Migration;

/**
 * Class m190110_044014_drop_and_add_all_tables
 */
class m190110_044014_drop_and_add_all_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->dropTable( 'car' );
		$this->dropTable( 'product' );
		$this->dropTable( 'category' );
		$this->dropTable( 'post' );
		
		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		//Таблица POST
		$this->createTable( 'post', [
			'post_id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'email' => $this->string(),
			'text' => $this->text()->notNull(),
		]);
		$this->insert('post', [
            'name' => 'Hello',
            'email' => 'Slowpoke159@gmail.com',
            'text' => 'Hello guyssss!',
        ]);
		
		//Таблица CATEGORY
		$this->createTable( 'category', [
			'category_id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
		]);
		
		$this->createIndex(
			'idx-category-category_id',
			'category',
			'category_id'
		);
		
		//Таблица PRODUCT
		$this->createTable( 'product', [
			'product_id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'category_id' => $this->integer()->defaultValue(1),
			'created_at' => $this->timestamp(),
		]);
		
		$this->addForeignKey( 
			'product_category_id_fk',
			'product',
			'category_id',
			'category',
			'category_id',
			'CASCADE'
		);
		
		//Таблица CAR
		$this->createTable( 'car', [
			'name' => $this->string(),
			'seats' => $this->integer(),
			'created_at' => $this->timestamp(),
		]);
		
		$this->addPrimaryKey( 'car_pk', 'car', 'name' );
		
		$this->batchInsert( 'car', [ 'name', 'seats', 'created_at' ], [
            [ 'BMW', '5' , date( "Y-m-d H:i:s" ) ],
            [ 'Bentley', '3' , date( "Y-m-d H:i:s" ) ],
            [ 'Audi', '4' , date( "Y-m-d H:i:s" ) ],
        ]);
		
		$this->createTable( 'shop', [
			'id' => $this->primaryKey(),
			'name' => $this->string(),
			'price' => $this->integer(),
		]);
    }
}
