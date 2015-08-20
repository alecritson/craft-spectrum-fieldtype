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
        craft()->templates->includeJs("$('#{$namespacedId}').spectrum({
        color: \"{$value}\",
        showInput: true,
        className: \"full-spectrum\",
        showInitial: true,
        showPalette: false,
        allowEmpty:true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: \"hex\"
        });");

        return craft()->templates->render('spectrum/input', array(
            'name'  => $name,
            'id' => $id,
            'value' => $value
        ));
    }
}