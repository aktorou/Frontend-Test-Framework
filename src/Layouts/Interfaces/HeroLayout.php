<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\Interfaces;

use ProtectedNet\FrontendTestFramework\Components\AbstractComponent;

interface HeroLayout
{
  /**
   * @param AbstractComponent $hero
   *
   * @return mixed
   */
  public function setHero($hero);
}
