<?php

class m150228_175422_addTableCurrencies extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction.
	public function safeUp()
	{
		$this->createTable('currencies',[
			'id' => 'pk',
			'name' => 'varchar(32) NOT NULL',
			'price' => 'decimal(11,6) NOT NULL',
			'symbol' => 'varchar(16) NOT NULL',
			'ts' => 'integer NOT NULL',
			'type' => 'integer(3) NOT NULL',
			'utctime' => 'datetime',
			'volume' => 'integer',
			'classname' => 'varchar(64) NOT NULL',
			'created_at' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
			'updated_at' => 'datetime',
		], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function safeDown()
	{
		$this->dropTable('currencies');
	}
}