<?php

namespace spec\Application\Game;

use Application\Game\Player;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Player::PLAYER_NAME_X);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(Player::PLAYER_NAME_X);
    }

    function it_can_be_named_o()
    {
        $this->beConstructedWith(Player::PLAYER_NAME_O);
        $this->shouldNotThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_cannot_be_named_y()
    {
        $this->beConstructedWith('Y');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_is_first_to_move_when_it_is_x()
    {
        $this->isFirstToMove()->shouldBe(true);
    }

    function it_is_not_first_to_move_when_it_is_o()
    {
        $this->beConstructedWith(Player::PLAYER_NAME_O);
        
        $this->isFirstToMove()->shouldBe(false);
    }
}
