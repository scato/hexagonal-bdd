<?php

namespace Repository;

use Application\Game\Game;
use Application\Game\GameRepository;
use Ramsey\Uuid\UuidInterface;

class GameRepositoryStub implements GameRepository
{
    /**
     * @var Game[]
     */
    private $games = array();

    /**
     * @param Game[] $games
     */
    public function __construct(array $games)
    {
        foreach ($games as $game) {
            $this->add($game);
        }
    }

    /**
     * @param UuidInterface $gameId
     * @return Game
     */
    public function get(UuidInterface $gameId)
    {
        return $this->games[$gameId->toString()];
    }

    /**
     * @param Game $game
     * @return void
     */
    public function add(Game $game)
    {
        $this->games[$game->getId()->toString()] = $game;
    }
}
