<?php
namespace ProtectedNet\FrontendTestFramework\Components;

use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\Dispatch\Component\UiComponentTrait;
use Packaged\Ui\Html\TemplatedHtmlElement;
use PackagedUi\BemComponent\BemComponent;
use PackagedUi\BemComponent\BemComponentTrait;

abstract class AbstractComponent extends TemplatedHtmlElement implements BemComponent, DispatchableComponent
{
  use BemComponentTrait;
  use UiComponentTrait;

  /** @var string */
  protected $_tag = "div";

  /** AbstractComponent constructor.*/
  public function __construct()
  {
    $this->addClass($this->getBlockName());
    $this->_initDispatchableComponent($this);
  }

  /**
   * @param string $name
   *
   * @return $this
   */
  protected function _addModifier(string $name)
  {
    return $this->addClass($this->getModifier($name));
  }

  /**
   * @param string $name
   *
   * @return $this
   */
  protected function _removeModifier(string $name)
  {
    return $this->removeClass($this->getModifier($name));
  }
}

