<?php

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class SpectrumTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'Spectrum filters';
    }

    public function getFilters()
    {
        $returnArray = array();
        
        $methods = array(
            'lighten',
            'darken',
            'brightness'
        );

        foreach ($methods as $methodName) {
            $returnArray[$methodName] = new \Twig_Filter_Method($this, $methodName);
        }

        return $returnArray;
    }

    /**
     * Adjusts the lightness of a colour
     * @param  String $hex   The base colour to work with
     * @param  String $steps The number of steps between 225 and 0
     * @return String        The resulting colour
     */
    public function lighten($hex, $steps)
    {
        if ($steps < 0)
        {
            $steps = $steps * -1;
        }
        return $this->adjustBrightness($hex, $steps);
    }

    /**
     * Adjusts the darkness of a colour
     * @param  String $hex   The base colour to work with
     * @param  String $steps The number of steps between -225 and 0
     * @return String        The resulting colour
     */
    public function darken($hex, $steps)
    {
        if($steps > 0) {
            $steps = $steps * -1;
        }
        return $this->adjustBrightness($hex, $steps);
    }

    /**
     * Adjusts the brightness of a colour
     * @param  String $hex   The base colour to work with
     * @param  String $steps The number of steps between -225 and 255
     * @return String        The resulting colour
     */
    public function brightness($hex, $steps)
    {
        return $this->adjustBrightness($hex, $steps);
    }

    // Private methods
    // =============================================================================

    /**
     * Actually performs the conversion
     * @param  String $hex   The base colour to work with
     * @param  String $steps The number of steps between -225 and 255
     * @return String        The resulting colour
     */
    private function adjustBrightness($hex, $steps) {

        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }

}