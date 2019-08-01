<?php
namespace ProtectedNet\FrontendTestFramework\Controllers;

use Generator;
use Packaged\Routing\Handler\Handler;
use Packaged\Routing\Route;

class DefaultController extends AbstractController
{
  /** @return callable|Handler|Route[]|Generator|string */
  protected function _generateRoutes()
  {
    yield self::_route('/_ah/health', 'statusCheck');
    yield self::_route('/(|home)$', 'homePage');
  }

  /** @return string */
  public function getStatusCheck()
  {
    return 'OK';
  }

  public function getHomePage()
  {
    return 'yay';
  }
}
