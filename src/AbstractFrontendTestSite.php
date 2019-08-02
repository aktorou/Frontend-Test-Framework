<?php
namespace ProtectedNet\FrontendTestFramework;

use Cubex\Application\Application;
use Cubex\Context\Context;
use Cubex\Cubex;
use Cubex\Events\Handle\ResponsePreSendHeadersEvent;
use ErrorException;
use Generator;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\Resources\ResourceFactory;
use Packaged\Helpers\Path;
use Packaged\Http\Response;
use Packaged\Routing\Handler\FuncHandler;
use Packaged\Routing\Handler\Handler;
use Packaged\Routing\Route;
use ProtectedNet\FrontendTestFramework\Dispatch\Dispatcher;

abstract class AbstractFrontendTestSite extends Application
{
  /**
   * @return callable|Generator|Handler|Route[]|string
   */
  protected function _generateRoutes()
  {
    //Handle our favicon
    yield self::_route(
      '/favicon.ico',
      new FuncHandler(
        function () { return ResourceFactory::fromFile(Path::system(dirname(__DIR__), 'public', 'favicon.ico')); }
      )
    );

    //Handle dispatched resources
    yield self::_route(
      Dispatcher::PATH,
      new FuncHandler(function (Context $c) { return Dispatch::instance()->handleRequest($c->request()); })
    );

    //Let the parent application handle routes from here
    return parent::_generateRoutes();
  }

  /**
   * TotalAvSite constructor.
   *
   * @param Cubex $cubex
   */
  public function __construct(Cubex $cubex)
  {
    parent::__construct($cubex);

    ini_set('precision', 14);
    ini_set('serialize_precision', 14);

    // Convert errors into exceptions
    set_error_handler(
      function ($errno, $errstr, $errfile, $errline) {
        if((error_reporting() & $errno) && !($errno & E_NOTICE))
        {
          throw new ErrorException($errstr, 0, $errno, str_replace(dirname(__DIR__), '', $errfile), $errline);
        }
      }
    );

    //Resource Handler
    Dispatcher::i(dirname(__DIR__));
  }

  protected function _initialize()
  {
    //Send debug headers locally
    $this->getCubex()->listen(
      ResponsePreSendHeadersEvent::class,
      function (ResponsePreSendHeadersEvent $e) {
        $response = $e->getResponse();
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block;');
        $response->headers->set('Referrer-Policy', 'strict-origin');
        $response->headers->set(
          'Feature-Policy',
          "accelerometer 'none'"
          . ";camera 'none'"
          . ";geolocation 'none'"
          . ";gyroscope 'none'"
          . ";magnetometer 'none'"
          . ";microphone 'none'"
          . ";payment 'none'"
          . ";usb 'none'"
        );
        $response->headers->set(
          'Content-Security-Policy',
          "default-src 'self'"
          . ";style-src 'self' 'unsafe-inline' https://fonts.googleapis.com"
          . ";frame-src 'self' https://player.vimeo.com https://gcs-vimeo.akamaized.net"
          . ";media-src 'self' https://player.vimeo.com https://gcs-vimeo.akamaized.net"
          . ";font-src 'self' https://fonts.gstatic.com"
          . ";script-src 'self' 'unsafe-inline'"
        );

        if($response instanceof Response && $e->getContext()->isEnv(Context::ENV_LOCAL))
        {
          $response->enableDebugHeaders();
        }
      }
    );
  }
}
