<?php

namespace AppBundle;

use Application\StartGameHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppBundleTest extends KernelTestCase
{
    /**
     * @test
     */
    public function shouldExposeStartGameHandler()
    {
        static::bootKernel();

        $startGameHandler = static::$kernel->getContainer()->get('app.start_game_handler');

        $this->assertInstanceOf(StartGameHandler::class, $startGameHandler);
    }
}
