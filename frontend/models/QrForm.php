<?php


namespace frontend\models;


use common\models\Code;
use common\models\Service\QrCodeService;
use yii\helpers\Url;

class QrForm extends \yii\base\Model
{
    public $id;
    public $title;
    public $params;

    public function rules()
    {
        return [
            [['title', 'params'], 'required'],
            [['id', 'title', 'params'], 'safe'],
            [['id'], 'integer'],
            [['title'], 'string'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => 'Название QR кода',
            'params' => 'Параметры',
        ];
    }

    public function loadFormAttributes(Code $code): void
    {
        $this->id = $code->id;
        $this->title = $code->title;
        foreach (explode(',', $code->params) as $params) {
            list($name, $value) = explode(':', $params);
            $name = preg_replace('~\"~', '', trim($name));
            $value = preg_replace('~\"~', '', trim($value));
            $this->params[$name] = $value;
        }
    }

    public function update(): bool
    {
        $service = new QrCodeService();

        if ($this->attributes) {
            $service->updateQr($this->attributes);
            return true;
        }

        return false;
    }
}