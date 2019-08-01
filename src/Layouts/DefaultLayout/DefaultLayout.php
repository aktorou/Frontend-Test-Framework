<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\DefaultLayout;

use Packaged\Dispatch\ResourceManager;
use ProtectedNet\FrontendTestFramework\Layouts\AbstractLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\FooterLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\HeroLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\NavLayout;
use ProtectedNet\FrontendTestFramework\Partials\Footer\Footer;
use ProtectedNet\FrontendTestFramework\Partials\Nav\Nav;
use ProtectedNet\TavBranding\TavBranding;
use ProtectedNet\UiComponents\Core\Link\Link;
use ProtectedNet\UiComponents\Core\Modal\Modal;

class DefaultLayout extends AbstractLayout implements NavLayout, HeroLayout, FooterLayout
{
  protected $_nav = false;
  protected $_footer = false;
  protected $_hero = false;

  public function __construct()
  {
    ResourceManager::resources()->includeCss('styles/global.min.css', null, 20);
    ResourceManager::resources()->includeJs('js/libraries.min.js', [], 20);
  }

  /** @return mixed|null */
  protected function _getHero()
  {
    if($this->_hero === false)
    {
      $this->_hero = null; // TODO: add default hero banner component or partial here
    }

    return $this->_hero;
  }

  /** @return mixed|null */
  protected function _getNav()
  {
    if($this->_nav === false)
    {
      $this->_nav = null; // TODO: add default nav component or partial here
    }

    return $this->_nav;
  }

  /** @return mixed|null */
  protected function _getFooter()
  {
    if($this->_footer === false)
    {
      $this->_footer = null; // TODO: add default footer component or partial here
    }

    return $this->_footer;
  }

  /**
   * @param $hero
   *
   * @return $this
   */
  public function setHero($hero)
  {
    $this->_hero = $hero;
    return $this;
  }

  /**
   * @param $nav
   *
   * @return $this
   */
  public function setNav($nav)
  {
    $this->_nav = $nav;
    return $this;
  }

  /**
   * @param $footer
   *
   * @return $this
   */
  public function setFooter($footer)
  {
    $this->_footer = $footer;
    return $this;
  }
}
