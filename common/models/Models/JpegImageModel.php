<?php


namespace common\models\Models;


use common\models\Interfaces\ImageInterface;
use GdImage;

class JpegImageModel implements ImageInterface
{
    /**
     * @var GdImage $image
     */
    protected GdImage $image;

    /**
     * @var string $img
     */
    protected string $img;

    public function __construct($img)
    {
        $this->img = $img;
        $this->image = imagecreatefromstring($img);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public function render(): string
    {
        list($width, $height) = getimagesizefromstring($this->img);
        $output = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($output,  255, 255, 255);
        imagefilledrectangle($output, 0, 0, $width, $height, $white);
        imagecopyresampled($output, $this->image, 0, 0, 0, 0, $width, $height, $width, $height);
        imagejpeg($output, null, 100);
        return "";
    }

}