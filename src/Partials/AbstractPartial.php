<?php
namespace ProtectedNet\FrontendTestFramework\Partials;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\Dispatch\Component\UiComponentTrait;
use Packaged\Ui\Html\TemplatedHtmlElement;
use PackagedUi\BemComponent\BemComponentTrait;

abstract class AbstractPartial extends TemplatedHtmlElement implements DispatchableComponent, ContextAware
{
  use BemComponentTrait;
  use UiComponentTrait;
  use ContextAwareTrait;

  protected $_tag = 'div';

  public function __construct()
  {
    $this->addClass($this->getBlockName());
    $this->_initDispatchableComponent($this);
  }

  /** @return $this */
  public static function i()
  {
    return new static();
  }

}
