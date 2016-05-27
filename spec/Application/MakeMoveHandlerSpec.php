<?php

namespace spec\Application;

use Application\Game\Board;
use Application\Game\Game;
use Application\Game\GameRepository;
use Application\Game\Move;
use Application\Game\MoveGenerator;
use Application\Game\Player;
use Application\MakeMoveCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

class MakeMoveHandlerSpec extends ObjectBehavior
{
    function let(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        UuidInterface $gameId,
        Game $game,
        MoveGenerator $moveGenerator
    ) {
        $this->beConstructedWith($gameRepository, $uuidFactory, $moveGenerator);

        $gameRepository->get($gameId)->willReturn($game);
        $uuidFactory->fromString('1234')->willReturn($gameId);
    }

    function it_should_make_a_move(Game $game, MoveGenerator $moveGenerator)
    {
        $command = new MakeMoveCommand();
        $command->gameId = '1234';
        $command->x = 0;
        $command->y = 0;

        $this->handle($command);

        $move = new Move(0, 0);

        $game->makeHumanMove($move, $moveGenerator)->shouldHaveBeenCalled();
    }
}
