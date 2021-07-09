<?php


namespace common\models\Models;


use common\models\Interfaces\ImageInterface;
use Exception;
use Yii;

class ImageModel
{
    /**
     * @var string $img
     */
    protected string $img;

    /**
     * @var ImageInterface $image
     */
    protected ImageInterface $image;

    public function __construct(string $img, string $mime)
    {
        $this->img = $img;
        $this->image = match ($mime) {
            'png' => new PngImageModel($this->img),
            'pdf' => new PdfImageModel($this->img),
            default => new JpegImageModel($this->img),
        };
    }

    public function render(): string
    {
        try {
            $string = $this->image->render();
        } catch (Exception $e) {
            Yii::warning($e->getMessage());
            return "";
        }

        return $string;
    }

}