<?php
/**
 * holds basic functionality that may be useful to all services
 *
 * @package App\Services
 */
declare(strict_types=1);

namespace App\Services;

use App\Services\Shared\Logger;

/**
 * Class ServiceBase
 * @package App\Services
 */
class ServiceBase
{
    /** @var Logger $logger */
    protected $logger;

    /**
     * ServiceBase constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger();
    }
}