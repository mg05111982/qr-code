<?php


namespace common\models\Models;


use common\models\Interfaces\ImageInterface;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use yii\base\InvalidConfigException;

class PdfImageModel implements ImageInterface
{
    /**
     * @var Pdf $image
     */
    protected Pdf $image;

    public function __construct($img)
    {
        $this->image = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => "<img src='data:image/jpeg;base64, ".base64_encode($img)."' />",
        ]);
    }

    /**
     * @return string
     *
     * @throws MpdfException
     * @throws CrossReferenceException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws InvalidConfigException
     */
    public function render(): string
    {
        return $this->image->render();
    }
}