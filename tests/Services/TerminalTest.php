<?php
/**
 * test the class App\Terminal
 *
 * @package Tests\Services
 */
declare(strict_types=1);

namespace Tests\Services;

use App\Services\Terminal;
use PHPUnit\Framework\TestCase;

/**
 * Class TerminalTest
 * @package Tests\Services
 */
class TerminalTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetTotalCanReturn3240(): void
    {
        /** @var Terminal $terminal */
        $terminal = new Terminal();
        $terminal->scanItem('ZA');
        $terminal->scanItem('YB');
        $terminal->scanItem('FC');
        $terminal->scanItem('GD');
        $terminal->scanItem('ZA');
        $terminal->scanItem('YB');
        $terminal->scanItem('ZA');
        $terminal->scanItem('ZA');

        $this->assertEquals(32.40, $terminal->getTotal(), 'Failed to return 32.40');
    }

    /**
     * @throws \Exception
     */
    public function testGetTotalCanReturn725(): void
    {
        /** @var Terminal $terminal */
        $terminal = new Terminal();
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');
        $terminal->scanItem('FC');

        $this->assertEquals(7.25, $terminal->getTotal(), 'Failed to return 7.25');
    }

    /**
     * @throws \Exception
     */
    public function testGetTotalCanReturn1540(): void
    {
        /** @var Terminal $terminal */
        $terminal = new Terminal();
        $terminal->scanItem('ZA');
        $terminal->scanItem('YB');
        $terminal->scanItem('FC');
        $terminal->scanItem('GD');

        $this->assertEquals(15.40, $terminal->getTotal(), 'Failed to return 15.40');
    }
}