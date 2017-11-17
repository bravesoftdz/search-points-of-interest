<?php

namespace Dykyi;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\NullLogger;

/**
 * Class Application
 * @package Dykyi
 */
class BaseApplication implements LoggerAwareInterface
{
    /** @var LoggerInterface */
    protected $logger;

    /**
     * BaseApplication constructor.
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }
}
