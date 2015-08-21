<?php
namespace Craft;

class Spectrum_ColorModel extends BaseModel
{
    public function __toString()
    {
        return (string) $this->color;
    }

    public function isLight()
    {
        $color = (string) $this->color;
        $r = hexdec(substr($color,0,2));
        $g = hexdec(substr($color,2,2));
        $b = hexdec(substr($color,4,2));

        $contrast = sqrt(
            $r * $r * .241 +
            $g * $g * .691 +
            $b * $b * .068
        );

        if($contrast > 130){
            return true;
        }else{
            return false;
        }
    }
    protected function defineAttributes()
    {
        return array(
            'color' => AttributeType::String
        );
    }
}