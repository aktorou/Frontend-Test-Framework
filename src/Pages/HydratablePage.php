<?php
namespace ProtectedNet\FrontendTestFramework\Pages;

use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\TavLayout;

interface HydratablePage
{
  /**
   * @param TavLayout $layout
   *
   * @return TavLayout
   */
  public function hydrateLayout(TavLayout $layout);
}
