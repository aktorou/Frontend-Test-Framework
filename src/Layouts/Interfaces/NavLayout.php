<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\Interfaces;

use ProtectedNet\FrontendTestFramework\Partials\AbstractPartial;

interface NavLayout
{
  /**
   * @param AbstractPartial $nav
   *
   * @return mixed
   */
  public function setNav(AbstractPartial $nav);
}
