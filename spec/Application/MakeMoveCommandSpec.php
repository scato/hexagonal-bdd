<?php

namespace spec\Application;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MakeMoveCommandSpec extends ObjectBehavior
{
    function it_has_a_game_id()
    {
        $this->gameId->shouldBeNull();
    }

    function it_has_an_x_value()
    {
        $this->x->shouldBeNull();
    }

    function it_has_a_y_value()
    {
        $this->y->shouldBeNull();
    }
}
