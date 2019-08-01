<?php
namespace ProtectedNet\FrontendTestFramework\Components;

use Exception;
use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\Dispatch\Component\UiComponentTrait;
use Packaged\Dispatch\ResourceManager;
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

  /** @return string */
  protected function _getTemplatedPhtmlClass()
  {
    return $this->_getTemplateClass();
  }

  /** @return string */
  abstract protected function _getTemplateClass(): string;

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

  /**
   * @param ResourceManager $manager
   *
   * @throws Exception
   */
  protected function _requireResources(ResourceManager $manager)
  {
    ResourceManager::componentClass(self::class)->requireCss('styles/component-styles.min.css');
  }
}

