<?php
/**
 * Throw exception and may be log n the syslog
 *
 * @package App\Services\Shared
 */
declare(strict_types=1);

namespace App\Services\Shared;

/**
 * Class Logger
 * @package App\Services\Shared
 */
class Logger
{
    /** @var string $message */
    private $message;

    /**
     * @param string $message
     * @param string $raisedByFile e.g. __FILE__
     * @param int $raisedFromLine e.g. __LINE__
     * @return $this
     */
    public function setMessage(string $message, string $raisedByFile, int $raisedFromLine): self
    {
        $this->message = "[{$raisedByFile}:{$raisedFromLine}]: {$message}";

        return $this;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function log(int $priority = LOG_ERR): self
    {
        syslog($priority, $this->message);

        return $this;
    }

    /**
     * @param int $code
     * @throws \Exception
     */
    public function throwException(int $code = 0): void
    {
        throw new \Exception($this->message, $code);
    }
}
