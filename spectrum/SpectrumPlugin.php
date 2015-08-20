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
    return '0.0.1';
  }
  function getDeveloper()
  {
    return 'Alec Ritson';
  }
  function getDeveloperUrl()
  {
    return 'http://itsalec.co.uk';
  }
}