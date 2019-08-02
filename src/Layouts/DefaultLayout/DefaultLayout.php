<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\DefaultLayout;

use ProtectedNet\FrontendTestFramework\Layouts\AbstractLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\FooterLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\HeroLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\NavLayout;

class DefaultLayout extends AbstractLayout implements NavLayout, HeroLayout, FooterLayout
{
  protected $_nav = false;
  protected $_footer = false;
  protected $_hero = false;

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
