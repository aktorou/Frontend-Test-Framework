<?php
namespace ProtectedNet\FrontendTestFramework\Layouts;

use Exception;
use Packaged\Context\ContextAwareTrait;
use Packaged\Ui\Element;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\TavLayout;

abstract class AbstractLayout extends Element implements TavLayout
{
  use ContextAwareTrait;

  protected $_siteTitle = 'Total AV';
  protected $_content = [];

  /**
   * @param $content
   *
   * @return $this
   */
  public function setContent($content)
  {
    $this->_content = (string)$content;
    return $this;
  }

  /**
   * @return array
   * @throws Exception
   */
  public function getContent()
  {
    return $this->_content;
  }

  /** @return string */
  public function getSiteTitle(): string
  {
    return $this->_siteTitle;
  }
}
