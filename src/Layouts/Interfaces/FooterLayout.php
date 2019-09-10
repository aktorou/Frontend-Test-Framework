<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\Interfaces;

use ProtectedNet\FrontendTestFramework\Partials\AbstractPartial;

interface FooterLayout
{
  /**
   * @param AbstractPartial $footer
   *
   * @return mixed
   */
  public function setFooter($footer);
}
