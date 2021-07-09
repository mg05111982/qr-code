<?php

use yii\db\Migration;

/**
 * Class m210708_111900_alter_codes_append_img
 */
class m210708_111900_alter_codes_append_img extends Migration
{
    public $tableName = 'code';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'img', $this->text() . ' AFTER clicks');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'img');
    }

}
