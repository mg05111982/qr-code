<?php


namespace common\models\DAO;


use common\models\Code;
use yii\db\ActiveQuery;

class QrCodeQueryDAO
{
    public function all(): ActiveQuery
    {
        return Code::find();
    }
}