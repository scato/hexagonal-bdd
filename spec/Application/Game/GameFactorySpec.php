<?php

namespace spec\Application\Game;

use Application\Game\Game;
use Application\Game\MoveGenerator;
use Application\Game\MoveGeneratorFactory;
use Application\Game\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidInterface;

class GameFactorySpec extends ObjectBehavior
{
    function let(MoveGeneratorFactory $moveGeneratorFactory, MoveGenerator $moveGenerator)
    {
        $this->beConstructedWith($moveGeneratorFactory);

        $moveGeneratorFactory->create()->willReturn($moveGenerator);
    }

    function it_should_create_a_game(UuidInterface $gameId)
    {
        $this->create($gameId, Player::PLAYER_NAME_X)->shouldHaveType(Game::class);
    }

    function it_should_assign_a_human_player(UuidInterface $gameId)
    {
        $this->create($gameId, Player::PLAYER_NAME_X)->getHumanPlayer()->getName()->shouldBe(Player::PLAYER_NAME_X);
    }

    function it_should_assign_a_computer_player(UuidInterface $gameId)
    {
        $this->create($gameId, Player::PLAYER_NAME_X)->getComputerPlayer()->getName()->shouldBe(Player::PLAYER_NAME_O);
    }
}
