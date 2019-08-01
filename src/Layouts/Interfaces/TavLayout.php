<?php
namespace ProtectedNet\FrontendTestFramework\Layouts\Interfaces;

use Packaged\Context\ContextAware;
use Packaged\Dispatch\Component\DispatchableComponent;
use Packaged\SafeHtml\ISafeHtmlProducer;
use Packaged\Ui\Renderable;

interface TavLayout extends ContextAware, DispatchableComponent, Renderable, ISafeHtmlProducer
{
  public function setContent($content);

  public function getSiteTitle(): string;
}
