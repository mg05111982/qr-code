<?php

use yii\db\Migration;

/**
 * Class m210708_110852_table_codes
 */
class m210708_110852_table_code extends Migration
{
    public $tableName = 'code';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'title' => $this->string(512),
            'params' => $this->string(),
            'clicks' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}
