<?php
namespace ProtectedNet\FrontendTestFramework\Dispatch;

use Packaged\Dispatch\Dispatch;

class Dispatcher extends Dispatch
{
  const PATH = '/_r';

  /**
   * @param $projectRoot
   *
   * @return Dispatch|Dispatcher
   */
  public static function i($projectRoot)
  {
    $inst = new Dispatcher($projectRoot, self::PATH);
    $inst->_configure();
    return Dispatch::bind($inst);
  }

  protected function _configure()
  {
    $this->config()->addItem('optimisation', 'webp', true);
    $this->addComponentAlias('ProtectedNet\FrontendTestFramework', 'TAV');
  }
}
