<?php

namespace spec\Application\Game;

use Application\Game\Move;
use Application\Game\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardSpec extends ObjectBehavior
{
    function it_should_start_out_empty()
    {
        $this->getNumberOfSymbols()->shouldBe(0);
    }

    function it_should_have_one_symbol_after_a_move()
    {
        $this->makeMove(new Move(0, 0), new Player(Player::PLAYER_NAME_X));

        $this->getNumberOfSymbols()->shouldBe(1);
    }
}
