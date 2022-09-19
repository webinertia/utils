<?php

declare(strict_types=1);

namespace Webinertia\Utils\Diagnostics;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Log\PsrLoggerAdapter as Logger;
use Laminas\Mvc\MvcEvent;

use function microtime;

class Timer extends AbstractListenerAggregate
{
    protected Logger $logger;
    protected float $startTime;
    protected float $endTime;
    protected float $elapsedTime;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /** @inheritDoc */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_BOOTSTRAP, [$this, 'start']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, [$this, 'stop']);
    }

    public function start(MvcEvent $event)
    {
        $this->startTime = microtime(true);
    }

    public function stop(MvcEvent $event)
    {
        $this->endTime     = microtime(true);
        $this->elapsedTime = $this->endTime - $this->startTime;
        $this->logger->debug('Elapsed time is: ' . $this->elapsedTime);
    }
}
