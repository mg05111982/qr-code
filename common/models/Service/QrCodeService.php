<?php


namespace common\models\Service;


use common\models\Code;
use common\models\Manager\QrCodeManager;
use common\models\Models\ImageModel;
use Da\QrCode\QrCode;
use frontend\models\FormPrepare\FormPrepare;
use http\Exception\InvalidArgumentException;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\helpers\Json;

class QrCodeService
{
    public function getQrList(): ActiveDataProvider
    {
        $manager = new QrCodeManager();

        $config = [
            'query' => $manager->findQuery(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ];

        return new ActiveDataProvider($config);
    }

    public function getQr($id): Code|null
    {
        $manager = new QrCodeManager();
        return $manager->getQrCode($id);
    }

    /**
     * @param $id
     * @param $mime
     *
     * @return string
     *
     * @throws Exception
     */
    public function getQrImage($id, $mime): string
    {
        $manager = new QrCodeManager();
        $image = new ImageModel(base64_decode($manager->getField($id, 'img')), $mime);

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        if ('pdf' === $mime) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="qr-code-'.time().'.pdf"');
        } else {
            header('Content-Type: image/' . $mime);
            header('Content-Disposition: attachment; filename="qr-code-'.time().'.'.$mime.'"');
        }

        header("Content-type: application/force-download");

        return $image->render();
    }

    #[ArrayShape(['success' => "string"])] public function generateQrImage($params): array
    {
        $paramsArray = Json::decode('{'.$params.'}');

        if (!is_array($paramsArray)) {
            throw new InvalidArgumentException('Не верный формат JSON');
        }

        $paramsArray += ['time' => time()];
        $id = $paramsArray['id'];

        try {
            $qr = (new QrCode(
                Yii::$app->params['gatewayUrl'] . '?' . implode('&', $paramsArray)))
                ->setSize(250)
                ->setMargin(5)
                ->useForegroundColor(51, 153, 255);

            $manager = new QrCodeManager();
            $manager->updateById($id, [[
                'name' => 'img',
                'value' => base64_encode($qr->writeString()),
            ]]);
        } catch (\Exception $e) {
            Yii::warning($e->getMessage());
            return ['success' => 'false'];
        }

        return ['success' => 'true'];
    }

    /**
     * @param $id
     *
     * @throws Exception
     */
    public function incrementQrRedirects($id): void
    {
        $manager = new QrCodeManager();
        $clicks = (int)$manager->getField($id, 'clicks');
        $manager->updateById($id, [
            [
                'name' => 'clicks',
                'value' => $clicks + 1,
            ],
        ]);
    }

    public function updateQr($form): void
    {
        $id = $form['id'] ?? null;
        $prepare = new FormPrepare($form);
        $data = $prepare->prepare();
        $manager = new QrCodeManager();
        $manager->updateById($id, $data);
    }

    public function deleteQr($id): void
    {
        $manager = new QrCodeManager();
        $manager->deleteById($id);
    }

}