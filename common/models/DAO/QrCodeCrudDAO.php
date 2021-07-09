<?php


namespace common\models\DAO;


use common\models\Code;
use yii\db\Exception;

class QrCodeCrudDAO
{
    public function all(): array
    {
        return Code::find()->all();
    }

    public function one($id): Code|null
    {
        return Code::findOne(['id' => $id]);
    }

    public function field($id, $field): string
    {
        /** @var Code $code */
        $code = Code::findOne(['id' => $id]);
        if (null === $code) {
            throw new Exception('Field not found in table');
        }
        return (string)$code->{$field};
    }

    public function update($id, $params): void
    {
        /** @var Code $code */
        $code = Code::findOne(['id' => $id]);
        if (null === $code) {
            $code = new Code();
        }
        foreach ($params as $param) {
            if ($code->hasAttribute($param['name'])) {
                $code->{$param['name']} = $param['value'];
            }
        }
        $code->save();
    }

    public function delete($id): void
    {
        Code::deleteAll(['id' => $id]);
    }
}