<?php

namespace spec\Application\Game;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoveSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 2);
    }

    function it_has_an_x_value()
    {
        $this->getX()->shouldBe(1);
    }

    function it_has_a_y_value()
    {
        $this->getY()->shouldBe(2);
    }
}
