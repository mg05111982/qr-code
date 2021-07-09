<?php


namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Code extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}