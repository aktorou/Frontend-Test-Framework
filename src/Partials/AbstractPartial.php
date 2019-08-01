<?php
namespace ProtectedNet\FrontendTestFramework\Partials;

use Exception;
use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\Dispatch\Component\UiComponentTrait;
use Packaged\Dispatch\ResourceManager;
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

  /**
   * @param ResourceManager $manager
   *
   * @throws Exception
   */
  protected function _requireResources(ResourceManager $manager)
  {
    ResourceManager::componentClass(self::class)->requireCss('styles/partials.min.css');
  }

  /** @return $this */
  public static function i()
  {
    return new static();
  }

  /** @return string */
  protected function _getTemplatedPhtmlClass()
  {
    return $this->_getTemplateClass();
  }

  /** @return string */
  abstract protected function _getTemplateClass(): string;

}
