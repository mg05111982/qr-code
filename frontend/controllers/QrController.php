<?php
namespace frontend\controllers;

use common\models\Code;
use common\models\Service\QrCodeService;
use frontend\models\QrForm;
use Yii;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Class QrController
 * @package frontend\controllers
 */
class QrController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'generate-code',
                            'get-code'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(): string
    {
        $service = new QrCodeService();
        return $this->render('index', ['qrList' => $service->getQrList()]);
    }

    public function actionGenerateCode($params)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $service = new QrCodeService();
        return $service->generateQrImage($params);
    }

    /**
     * @param int $id
     * @param string $mime
     *
     * @return string
     *
     * @throws Exception
     */
    public function actionGetCode(int $id, string $mime): string
    {
        $service = new QrCodeService();
        return $service->getQrImage($id, $mime);
    }

    public function actionCreate(): string
    {
        $model = new QrForm();
        return $this->render('update', ['model' => $model]);
    }

    public function actionUpdate(): string|Response
    {
        $id = Yii::$app->request->get('id');
        $form = Yii::$app->request->post();

        $service = new QrCodeService();
        /** @var Code $qr */
        $qr = $service->getQr($id);

        $model = new QrForm();

        if ($form && $model->load($form) && $model->update()) {
            $this->redirect(Url::to(['qr/index']));
        } else if($id && $qr) {
            $model->loadFormAttributes($qr);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id): Response
    {
        $service = new QrCodeService();
        $service->deleteQr($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

}