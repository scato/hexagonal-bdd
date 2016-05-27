<?php

namespace spec\Application;

use Application\Game\Game;
use Application\Game\GameFactory;
use Application\Game\GameRepository;
use Application\Game\MoveGenerator;
use Application\Game\MoveGeneratorFactory;
use Application\StartGameCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

class StartGameHandlerSpec extends ObjectBehavior
{
    function let(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        UuidInterface $gameId,
        GameFactory $gameFactory,
        Game $game,
        MoveGeneratorFactory $moveGeneratorFactory,
        MoveGenerator $moveGenerator
    ) {
        $this->beConstructedWith($gameRepository, $uuidFactory, $gameFactory, $moveGeneratorFactory);

        $uuidFactory->fromString('1234')->willReturn($gameId);
        $gameFactory->create($gameId, 'X')->willReturn($game);
        $moveGeneratorFactory->create()->willReturn($moveGenerator);
    }

    function it_should_start_a_game(GameRepository $gameRepository, Game $game, MoveGenerator $moveGenerator)
    {
        $command = new StartGameCommand();
        $command->gameId = '1234';
        $command->playerName = 'X';

        $this->handle($command);

        $game->start($moveGenerator)->shouldHaveBeenCalled();
        $gameRepository->add($game)->shouldHaveBeenCalled();
    }
}
