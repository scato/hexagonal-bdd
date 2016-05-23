<?php

namespace spec\Application;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetGameQuerySpec extends ObjectBehavior
{
    function it_has_a_game_id()
    {
        $this->gameId->shouldBeNull();
    }
}
