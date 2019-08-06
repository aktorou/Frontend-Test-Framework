<?php
namespace ProtectedNet\FrontendTestFramework\Pages;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\Dispatch\Component\UiComponentTrait;
use Packaged\Ui\Html\TemplatedHtmlElement;
use ProtectedNet\FrontendTestFramework\Components\AbstractComponent;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\FooterLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\HeroLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\NavLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\TavLayout;
use ProtectedNet\FrontendTestFramework\Partials\AbstractPartial;

abstract class AbstractPage extends TemplatedHtmlElement implements DispatchableComponent, ContextAware, HydratablePage
{
  use UiComponentTrait;
  use ContextAwareTrait;

  public function __construct()
  {
    $this->_initDispatchableComponent($this);
  }

  protected $_tag = 'main';

  /** @return $this */
  public static function i()
  {
    return new static();
  }

  /**
   * @return AbstractComponent|false|null
   */
  protected function _getHeroBanner()
  {
    return false;
  }

  /**
   * @return AbstractPartial|false|null
   */
  protected function _getFooter()
  {
    return false;
  }

  /**
   * @return AbstractPartial|false|null
   */
  protected function _getNav()
  {
    return false;
  }

  /**
   * @param TavLayout $layout
   *
   * @return TavLayout
   */
  public function hydrateLayout(TavLayout $layout)
  {
    if($layout instanceof NavLayout)
    {
      $nav = $this->_getNav();
      if($nav !== false)
      {
        $layout->setNav($nav);
      }
    }

    if($layout instanceof HeroLayout)
    {
      $heroBanner = $this->_getHeroBanner();
      if($heroBanner !== null)
      {
        $layout->setHero($heroBanner);
      }
    }

    if($layout instanceof FooterLayout)
    {
      $footer = $this->_getFooter();
      if($footer !== false)
      {
        $layout->setFooter($footer);
      }
    }

    return $layout->setContent($this->render());
  }
}

