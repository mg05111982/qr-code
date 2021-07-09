<?php


namespace backend\controllers;


use common\models\Service\QrCodeService;
use yii\web\Controller;

class GatewayController extends Controller
{
    public function actionIndex(int $id): string
    {
        $service = new QrCodeService();
        $service->incrementQrRedirects($id);

        return $this->renderPartial('index');
    }
}