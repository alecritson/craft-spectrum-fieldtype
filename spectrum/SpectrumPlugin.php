<?php

namespace Craft;

class SpectrumPlugin extends BasePlugin
{
  function getName()
  {
    return Craft::t('Spectrum');
  }
  function getVersion()
  {
    return '0.10.2';
  }
  function getDeveloper()
  {
    return 'Alec Ritson';
  }
  function getDeveloperUrl()
  {
    return 'http://itsalec.co.uk';
  }
  public function addTwigExtension()
  {
      Craft::import('plugins.spectrum.twigextensions.SpectrumTwigExtension');
      return new SpectrumTwigExtension();
  }
  protected function defineSettings()
  {
      return array(
          'palette' => array(AttributeType::Mixed)
      );
  }
  public function getSettingsHtml()
  {
     return craft()->templates->render('spectrum/settings', array(
         'settings' => $this->getSettings()
     ));
  }
}