<?php

namespace Application\Game;

use Ramsey\Uuid\UuidInterface;

class GameFactory
{
    /**
     * @var MoveGeneratorFactory
     */
    private $moveGeneratorFactory;

    /**
     * @param MoveGeneratorFactory $moveGeneratorFactory
     */
    public function __construct(MoveGeneratorFactory $moveGeneratorFactory)
    {
        $this->moveGeneratorFactory = $moveGeneratorFactory;
    }

    /**
     * @param UuidInterface $gameId
     * @param $playerName
     * @return Game
     */
    public function create(UuidInterface $gameId, $playerName)
    {
        $humanPlayer = new Player($playerName);
        $computerPlayer = new Player($this->getOpponentName($playerName));
        $moveGenerator = $this->moveGeneratorFactory->create();

        return new Game($gameId, $humanPlayer, new Board(), $computerPlayer, $moveGenerator);
    }

    /**
     * @param string $playerName
     * @return string
     */
    private function getOpponentName($playerName)
    {
        if ($playerName === Player::PLAYER_NAME_X) {
            return Player::PLAYER_NAME_O;
        }

        return Player::PLAYER_NAME_X;
    }
}
