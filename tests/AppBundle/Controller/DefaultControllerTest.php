<?php

namespace Tests\AppBundle\Controller;

use Application\StartGameCommand;
use Application\StartGameHandler;
use Doctrine\ORM\EntityManager;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function shouldShowAStartButton()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('form[action$="/start"][method="post"]'));
        $this->assertCount(1, $crawler->filter('form[action$="/start"][method="post"] button'));
    }

    /**
     * @test
     */
    public function shouldStartAGame()
    {
        $prophet = new Prophet();
        $startGameHandler = $prophet->prophesize(StartGameHandler::class);

        $client = static::createClient();
        $client->getKernel()->getContainer()->set('app.start_game_handler', $startGameHandler->reveal());

        $client->request('POST', '/start');

        $startGameHandler->handle(Argument::type(StartGameCommand::class))->shouldHaveBeenCalled();

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('/play/', $client->getResponse()->headers->get('Location'));
    }
}
