<?php

namespace Application\Game;

use Ramsey\Uuid\UuidInterface;

interface GameRepository
{
    /**
     * @param UuidInterface $gameId
     * @return Game
     */
    public function get(UuidInterface $gameId);

    /**
     * @param Game $game
     * @return void
     */
    public function add(Game $game);
}
