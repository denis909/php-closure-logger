<?php
/**
 * @author denis909 <dev@denis909.spb.ru>
 * @license MIT
 * @link https://denis909.spb.ru
 */
namespace denis909\php;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Closure;

class ClosureLogger extends AbstractLogger
{
    public $levels = [
        LogLevel::EMERGENCY,
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::ERROR,
        LogLevel::WARNING,
        LogLevel::NOTICE,
        LogLevel::INFO,
        LogLevel::DEBUG
    ];

    public Closure $closure;

    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    public function log($level, $message, array $context = [])
    {
        if (array_search($level, $this->levels) === false)
        {
            return;
        }

        $closure = $this->closure;

        $closure($level, $message, $context);
    }
}
