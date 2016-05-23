<?php

namespace spec\Application;

use Application\Game\Game;
use Application\Game\GameRepository;
use Application\GetGameQuery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

class GetGameHandlerSpec extends ObjectBehavior
{
    function let(
        UuidFactoryInterface $uuidFactory,
        UuidInterface $gameId,
        GameRepository $gameRepository,
        Game $game
    ) {
        $this->beConstructedWith($uuidFactory, $gameRepository);

        $uuidFactory->fromString('1234')->willReturn($gameId);
        $gameRepository->get($gameId)->willReturn($game);
    }

    function it_should_get_a_game(Game $game)
    {
        $query = new GetGameQuery();
        $query->gameId = '1234';

        $this->handle($query)->shouldBe($game);
    }
}
