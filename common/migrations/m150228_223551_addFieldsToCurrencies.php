<?php

class m150228_223551_addFieldsToCurrencies extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->addColumn(Currencies::model()->tableName(), 'change', 'decimal(11,7) DEFAULT NULL AFTER `classname`');
		$this->addColumn(Currencies::model()->tableName(), 'chg_percent', 'decimal(11,7) DEFAULT NULL AFTER `change`');
	}

	public function safeDown()
	{
		$this->dropColumn(Currencies::model()->tableName(), 'change');
		$this->dropColumn(Currencies::model()->tableName(), 'chg_percent');
	}

}