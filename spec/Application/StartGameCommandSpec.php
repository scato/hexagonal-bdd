<?php

namespace spec\Application;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StartGameCommandSpec extends ObjectBehavior
{
    function it_has_a_game_id()
    {
        $this->gameId->shouldBeNull();
    }

    function it_has_a_player_name()
    {
        $this->playerName->shouldBeNull();
    }
}
