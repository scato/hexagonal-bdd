<?php

namespace AppBundle\Repository;

use Application\Game\Board;
use Application\Game\Game;
use Application\Game\Player;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

class DoctrineGameRepositoryTest extends KernelTestCase
{
    public function setUp()
    {
        static::bootKernel();

        $application = new Application(static::$kernel);
        $application->setAutoExit(false);

        $input = new StringInput('doctrine:schema:create');
        $output = new BufferedOutput();
        $exitCode = $application->run($input, $output);

        $this->assertEquals(0, $exitCode, $output->fetch());
    }

    /**
     * @test
     */
    public function shouldGetGames()
    {
        $gameId = Uuid::uuid4();
        $entityManager = static::$kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        $entityManager->persist($this->createGame($gameId));
        $entityManager->flush();
        $entityManager->clear();

        $repository = $entityManager->getRepository(Game::class);

        $game = $repository->get($gameId);

        $this->assertInstanceOf(Game::class, $game);
        $this->assertInstanceOf(Uuid::class, $game->getId());
        $this->assertInstanceOf(Board::class, $game->getBoard());
    }

    /**
     * @test
     */
    public function shouldFailToGetNonExistentGame()
    {
        $gameId = Uuid::uuid4();
        $entityManager = static::$kernel->getContainer()->get('doctrine.orm.default_entity_manager');

        $repository = $entityManager->getRepository(Game::class);

        $this->expectException(RuntimeException::class);

        $repository->get($gameId);
    }

    /**
     * @test
     */
    public function shouldAddGames()
    {
        $gameId = Uuid::uuid4();
        $game = $this->createGame($gameId);

        $entityManager = static::$kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        $repository = $entityManager->getRepository(Game::class);

        $repository->add($game);
        $entityManager->flush();
        $entityManager->clear();

        $games = $entityManager->getRepository(Game::class)->findAll();

        $this->assertCount(1, $games);
        $this->assertNotSame($game, $games[0]);
        $this->assertTrue($games[0]->getId()->equals($gameId));
    }

    /**
     * @param UuidInterface $gameId
     * @return Game
     */
    private function createGame(UuidInterface $gameId)
    {
        $game = new Game($gameId, new Player('X'), new Board(), new Player('O'));
        return $game;
    }
}
