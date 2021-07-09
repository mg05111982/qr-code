<?php


namespace common\models\Models;


use common\models\Interfaces\ImageInterface;
use GdImage;

class PngImageModel implements ImageInterface
{
    /**
     * @var GdImage $image
     */
    protected GdImage $image;

    public function __construct($img)
    {
        $this->image = imagecreatefromstring($img);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public function render(): string
    {
        ob_start();
        imagepng($this->image);
        return ob_get_clean();
    }

}