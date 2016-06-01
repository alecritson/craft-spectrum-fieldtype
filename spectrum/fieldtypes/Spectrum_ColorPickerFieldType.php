<?php
namespace Craft;

class Spectrum_ColorPickerFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Spectrum color picker');
    }

    public function getInputHtml($name, $value)
    {
        // Reformat the input name into something that looks more like an ID
        $id = craft()->templates->formatInputId($name);

        // Figure out what that ID is going to look like once it has been namespaced
        $namespacedId = craft()->templates->namespaceInputId($id);

        craft()->templates->includeJsResource('spectrum/spectrum-lib.js');
        craft()->templates->includeCssResource('spectrum/spectrum-lib.css');
        craft()->templates->includeCssResource('spectrum/spectrum.css');

        // Get the input settings
        $inputSettings = $this->getSettings();

        // Start our spectrum input
        $spectrum = "$('#{$namespacedId}').spectrum({";

        $spectrum .= "color: \"" . $value . "\",";

        $spectrum .= "chooseText : " . "\"". Craft::t('Set color') . "\",";

        $colors = '[';

        foreach($inputSettings as $key => $setting)
        {
            if($setting)
            {
                if($key == 'palette' || $key == 'useDefaultPalette')
                {
                    

                    if($key == 'useDefaultPalette')
                    {
                        $plugin = craft()->plugins->getPlugin('spectrum');
                        if($defaultPalette = $plugin->getSettings()->getAttribute('palette'))
                        {
                            foreach ($defaultPalette as $color) {
                                $colors .= "\"{$color['color']}\"" . ",";
                            }
                        }
                    }
                    if($key == 'palette')
                    {
                        foreach($setting as $color)
                        {
                            $colors .= "\"{$color['color']}\"" . ",";
                        }
                    }
                }
                else
                {
                    $spectrum .= $key . ": \"" . $setting . "\",";
                }
            }
        }

        $colors .= ']';
        $spectrum .= "palette: [" . $colors . "],";

        $spectrum .= "});";

        craft()->templates->includeJs($spectrum);

        return craft()->templates->render('spectrum/field/input', array(
            'name'  => $name,
            'id' => $id,
            'value' => $value
        ));
    }

    public function getSettingsHtml()
    {
        $plugin = craft()->plugins->getPlugin('spectrum');
        return craft()->templates->render('spectrum/field/settings', array(
            'defaultPalette' => $plugin->getSettings()->getAttribute('palette'),
            'settings' => $this->getSettings()
        ));
    }  

    public function prepValue($value)
    {
        $model = new Spectrum_ColorModel();
        $model->color = $value;
        return $model;
    }

    protected function defineSettings()
    {
        return array(
            'palette' => AttributeType::Mixed,
            'allowEmpty' => AttributeType::Bool,
            'showInput' => AttributeType::Bool,
            'showAlpha' => AttributeType::Bool,
            'showPalette' => AttributeType::Bool,
            'showPaletteOnly' => AttributeType::Bool,
            'useDefaultPalette' => AttributeType::Bool,
            'preferredFormat' => AttributeType::String
        );
    }

}