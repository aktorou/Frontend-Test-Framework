<?php
namespace ProtectedNet\FrontendTestFramework\Controllers;

use Cubex\Controller\Controller;
use Exception;
use Packaged\Context\Context;
use Packaged\Context\ContextAware;
use Packaged\Ui\Renderable;
use ProtectedNet\FrontendTestFramework\Layouts\BaseLayout\BaseLayout;
use ProtectedNet\FrontendTestFramework\Layouts\DefaultLayout\DefaultLayout;
use ProtectedNet\FrontendTestFramework\Layouts\Interfaces\TavLayout;

abstract class AbstractController extends Controller
{
  /** @var TavLayout */
  private $_layout = null;

  /**
   * @param TavLayout $layout
   *
   * @return $this
   */
  public function setLayout(TavLayout $layout)
  {
    $this->_layout = $layout;

    return $this;
  }

  /**
   * @return TavLayout
   * @throws Exception
   */
  public function getLayout(): TavLayout
  {
    if(!$this->_layout)
    {
      $this->_layout = new DefaultLayout();
    }

    return $this->_layout;
  }

  /**
   * @param Context $c
   * @param mixed   $result
   * @param null    $buffer
   *
   * @return mixed|\Packaged\Http\Response
   * @throws Exception
   */
  protected function _prepareResponse(Context $c, $result, $buffer = null)
  {
    if($result instanceof ContextAware)
    {
      $result->setContext($c);
    }

    if(!$result && $buffer)
    {
      $result = $buffer;
    }

    if(is_scalar($result) || $result instanceof Renderable)
    {
      // Setup the layout
      $theme = $this->getLayout();
      if($theme instanceof ContextAware)
      {
        $theme->setContext($this->getContext());
      }

      $theme->setContent($result);

      $baseLayout = new BaseLayout();
      $this->_bindContext($baseLayout);
      $baseLayout->setContent($theme);

      return parent::_prepareResponse($c, $baseLayout, $buffer);
    }

    return parent::_prepareResponse($c, $result, $buffer);
  }
}
