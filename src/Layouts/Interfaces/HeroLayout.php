<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\Interfaces;

use ProtectedNet\UiComponents\AbstractComponent;

interface HeroLayout
{
  /**
   * @param AbstractComponent $hero
   *
   * @return mixed
   */
  public function setHero(AbstractComponent $hero);
}
